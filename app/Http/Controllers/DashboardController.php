<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalEquipments = Equipment::count();

        // Agrupa os status em uma única consulta e reaproveita o resultado nos cards e no gráfico.
        $statusCounts = Equipment::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->map(fn ($total) => (int) $total)
            ->toArray();

        $equipmentsInUse = $statusCounts[Equipment::STATUS_IN_USE] ?? 0;
        $equipmentsAvailable = $statusCounts[Equipment::STATUS_AVAILABLE] ?? 0;
        $equipmentsMaintenance = $statusCounts[Equipment::STATUS_MAINTENANCE] ?? 0;

        $totalMaintenances = Maintenance::count();
        $openMaintenances = Maintenance::where('status', Maintenance::STATUS_OPEN)->count();

        // Os arrays abaixo já saem no formato esperado pelo Chart.js.
        $equipmentStatusChart = $this->buildEquipmentStatusChart($statusCounts);
        $equipmentCategoryChart = $this->buildEquipmentCategoryChart();
        $maintenanceMonthChart = $this->buildMaintenanceMonthChart();

        return view('dashboard', compact(
            'totalEquipments',
            'equipmentsInUse',
            'equipmentsAvailable',
            'equipmentsMaintenance',
            'totalMaintenances',
            'openMaintenances',
            'equipmentStatusChart',
            'equipmentCategoryChart',
            'maintenanceMonthChart'
        ));
    }

    /**
     * Monta a distribuição dos equipamentos por status com quantidade e porcentagem.
     *
     * @param  array<string, int>  $statusCounts
     * @return array<string, mixed>
     */
    private function buildEquipmentStatusChart(array $statusCounts): array
    {
        $statusPresentation = [
            Equipment::STATUS_IN_USE => [
                'label' => 'Em uso',
                'color' => '#0284c7',
                'always_show' => true,
            ],
            Equipment::STATUS_AVAILABLE => [
                'label' => 'Disponível',
                'color' => '#2563eb',
                'always_show' => true,
            ],
            Equipment::STATUS_MAINTENANCE => [
                'label' => 'Em manutenção',
                'color' => '#f59e0b',
                'always_show' => true,
            ],
            Equipment::STATUS_RETIRED => [
                'label' => 'Desativado',
                'color' => '#64748b',
                'always_show' => false,
            ],
            Equipment::STATUS_RESERVED => [
                'label' => 'Reservado',
                'color' => '#7c3aed',
                'always_show' => false,
            ],
        ];

        // Mantém o gráfico completo mesmo se aparecer algum status legado no banco.
        foreach ($statusCounts as $status => $total) {
            if (! array_key_exists($status, $statusPresentation)) {
                $statusPresentation[$status] = [
                    'label' => ucwords(str_replace('_', ' ', (string) $status)),
                    'color' => '#94a3b8',
                    'always_show' => false,
                ];
            }
        }

        $total = array_sum($statusCounts);
        $items = collect($statusPresentation)
            ->map(function (array $status, string $key) use ($statusCounts, $total): array {
                $value = (int) ($statusCounts[$key] ?? 0);

                return [
                    'label' => $status['label'],
                    'value' => $value,
                    'percentage' => $total > 0 ? round(($value / $total) * 100, 1) : 0,
                    'color' => $status['color'],
                    'always_show' => $status['always_show'],
                ];
            })
            ->filter(fn (array $item): bool => $item['always_show'] || $item['value'] > 0)
            ->map(fn (array $item): array => collect($item)->except('always_show')->all())
            ->values();

        return [
            'labels' => $items->pluck('label')->all(),
            'values' => $items->pluck('value')->all(),
            'percentages' => $items->pluck('percentage')->all(),
            'colors' => $items->pluck('color')->all(),
            'items' => $items->all(),
            'total' => $total,
        ];
    }

    /**
     * Conta equipamentos por categoria com JOIN e GROUP BY para evitar N+1.
     *
     * @return array<string, mixed>
     */
    private function buildEquipmentCategoryChart(): array
    {
        $items = Category::query()
            ->leftJoin('equipments', 'equipments.category_id', '=', 'categories.id')
            ->select('categories.name')
            ->selectRaw('COUNT(equipments.id) as total')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('categories.name')
            ->get()
            ->map(fn ($category): array => [
                'label' => $category->name,
                'value' => (int) $category->total,
            ]);

        return [
            'labels' => $items->pluck('label')->all(),
            'values' => $items->pluck('value')->all(),
            'items' => $items->all(),
        ];
    }

    /**
     * Agrupa manutenções dos últimos 12 meses pela data da manutenção.
     *
     * @return array<string, mixed>
     */
    private function buildMaintenanceMonthChart(): array
    {
        $months = collect(range(11, 0))
            ->map(fn (int $monthsAgo) => now()->subMonths($monthsAgo)->startOfMonth());

        $monthExpression = $this->monthGroupExpression();
        $monthlyCounts = Maintenance::query()
            ->whereDate('maintenance_date', '>=', $months->first()->toDateString())
            ->whereDate('maintenance_date', '<=', now()->endOfMonth()->toDateString())
            ->selectRaw($monthExpression.' as month_key, COUNT(*) as total')
            ->groupByRaw($monthExpression)
            ->orderBy('month_key')
            ->pluck('total', 'month_key')
            ->map(fn ($total) => (int) $total);

        $items = $months->map(function ($month) use ($monthlyCounts): array {
            $monthKey = $month->format('Y-m');

            return [
                'label' => $month->format('m/Y'),
                'value' => (int) ($monthlyCounts[$monthKey] ?? 0),
            ];
        });

        return [
            'labels' => $items->pluck('label')->all(),
            'values' => $items->pluck('value')->all(),
            'items' => $items->all(),
        ];
    }

    /**
     * Expressão SQL para agrupar datas por ano e mês nos bancos mais comuns.
     */
    private function monthGroupExpression(): string
    {
        return match (DB::connection()->getDriverName()) {
            'sqlite' => "strftime('%Y-%m', maintenance_date)",
            'pgsql' => "to_char(maintenance_date, 'YYYY-MM')",
            'sqlsrv' => "CONVERT(char(7), maintenance_date, 120)",
            default => "DATE_FORMAT(maintenance_date, '%Y-%m')",
        };
    }
}
