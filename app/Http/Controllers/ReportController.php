<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Display the reports index page with filters and results.
     */
    public function index(Request $request): View
    {
        $filters = $this->formatFilters($this->validateFilters($request));

        // Retrieve filtered equipments and maintenances
        $equipments = $this->getFilteredEquipments($filters);
        $maintenances = $this->getFilteredMaintenances($filters);

        // Calculate summary cards
        $summary = $this->calculateSummary($equipments, $maintenances);

        // Retrieve filter options
        $categories = Category::query()->orderBy('name')->pluck('name', 'id');
        $sectors = Sector::query()->orderBy('name')->pluck('name', 'id');
        $equipmentStatuses = Equipment::statuses();
        $maintenanceStatuses = Maintenance::statuses();

        return view('reports.index', compact(
            'equipments',
            'maintenances',
            'summary',
            'categories',
            'sectors',
            'equipmentStatuses',
            'maintenanceStatuses',
            'filters'
        ));
    }

    /**
     * Export filtered data to PDF.
     */
    public function exportPdf(Request $request): StreamedResponse
    {
        $filters = $this->formatFilters($this->validateFilters($request));

        $equipments = $this->getFilteredEquipments($filters);
        $maintenances = $this->getFilteredMaintenances($filters);
        $summary = $this->calculateSummary($equipments, $maintenances);

        $pdf = Pdf::loadView('reports.pdf', compact(
            'equipments',
            'maintenances',
            'summary',
            'filters'
        ));

        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="relatorio_' . now()->format('Y-m-d_His') . '.pdf"',
        ]);
    }

    /**
     * Export filtered data to CSV.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $filters = $this->validateFilters($request);

        $equipments = $this->getFilteredEquipments($filters);
        $maintenances = $this->getFilteredMaintenances($filters);

        $filename = 'relatorio_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        return response()->stream(function () use ($equipments, $maintenances) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['RELATÓRIO DE EQUIPAMENTOS E MANUTENÇÕES']);
            fputcsv($handle, ['Gerado em ' . now()->format('d/m/Y H:i:s')]);
            fputcsv($handle, []);

            if ($equipments->isNotEmpty()) {
                fputcsv($handle, ['EQUIPAMENTOS']);
                fputcsv($handle, ['Patrimônio', 'Nome', 'Categoria', 'Marca', 'Setor', 'Status']);

                foreach ($equipments as $equipment) {
                    fputcsv($handle, [
                        $equipment->asset_number,
                        $equipment->name,
                        $equipment->category?->name ?? 'N/A',
                        $equipment->brand?->name ?? 'N/A',
                        $equipment->sector?->name ?? 'N/A',
                        $equipment->statusLabel(),
                    ]);
                }

                fputcsv($handle, []);
            }

            if ($maintenances->isNotEmpty()) {
                fputcsv($handle, ['MANUTENÇÕES']);
                fputcsv($handle, ['Equipamento', 'Tipo', 'Data', 'Status', 'Técnico']);

                foreach ($maintenances as $maintenance) {
                    fputcsv($handle, [
                        $maintenance->equipment?->name ?? 'N/A',
                        $maintenance->maintenance_type,
                        $maintenance->maintenance_date->format('d/m/Y'),
                        $maintenance->statusLabel(),
                        $maintenance->user?->name ?? 'N/A',
                    ]);
                }
            }

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Validate and retrieve filter parameters.
     */
    private function validateFilters(Request $request): array
    {
        return $request->validate([
            'category_id' => 'nullable|integer',
            'sector_id' => 'nullable|integer',
            'equipment_status' => 'nullable|in:available,in_use,maintenance,reserved,retired',
            'maintenance_status' => 'nullable|in:open,in_progress,completed,canceled',
            'date_from' => 'nullable|date|date_format:Y-m-d',
            'date_to' => 'nullable|date|date_format:Y-m-d|after_or_equal:date_from',
        ]);
    }

    /**
     * Add human-readable filter labels for reports and exports.
     */
    private function formatFilters(array $filters): array
    {
        if (!empty($filters['category_id'])) {
            $filters['category_name'] = Category::find($filters['category_id'])?->name;
        }

        if (!empty($filters['sector_id'])) {
            $filters['sector_name'] = Sector::find($filters['sector_id'])?->name;
        }

        if (!empty($filters['equipment_status'])) {
            $equipmentStatuses = Equipment::statuses();
            $filters['equipment_status_label'] = $equipmentStatuses[$filters['equipment_status']] ?? $filters['equipment_status'];
        }

        if (!empty($filters['maintenance_status'])) {
            $maintenanceStatuses = Maintenance::statuses();
            $filters['maintenance_status_label'] = $maintenanceStatuses[$filters['maintenance_status']] ?? $filters['maintenance_status'];
        }

        return $filters;
    }

    /**
     * Get filtered equipments with eager loading.
     */
    private function getFilteredEquipments(array $filters)
    {
        $query = Equipment::query()
            ->with(['category:id,name', 'brand:id,name', 'sector:id,name'])
            ->orderByDesc('created_at');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['sector_id'])) {
            $query->where('sector_id', $filters['sector_id']);
        }

        if (!empty($filters['equipment_status'])) {
            $query->where('status', $filters['equipment_status']);
        }

        return $query->get();
    }

    /**
     * Get filtered maintenances with eager loading.
     */
    private function getFilteredMaintenances(array $filters)
    {
        $query = Maintenance::query()
            ->with(['equipment:id,name', 'user:id,name'])
            ->orderByDesc('maintenance_date');

        if (!empty($filters['maintenance_status'])) {
            $query->where('status', $filters['maintenance_status']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('maintenance_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('maintenance_date', '<=', $filters['date_to']);
        }

        return $query->get();
    }

    /**
     * Calculate summary statistics.
     */
    private function calculateSummary($equipments, $maintenances): array
    {
        $totalEquipments = $equipments->count();
        $equipmentsInUse = $equipments->where('status', Equipment::STATUS_IN_USE)->count();
        $equipmentsInMaintenance = $equipments->where('status', Equipment::STATUS_MAINTENANCE)->count();
        $totalMaintenances = $maintenances->count();

        return compact(
            'totalEquipments',
            'equipmentsInUse',
            'equipmentsInMaintenance',
            'totalMaintenances'
        );
    }
}
