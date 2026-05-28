<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Maintenance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaintenanceController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'equipment_id' => ['nullable', 'integer', 'exists:equipments,id'],
            'status' => ['nullable', 'string', Rule::in(array_keys(Maintenance::statuses()))],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $maintenances = Maintenance::query()
            ->with(['equipment', 'user'])
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where('problem_description', 'like', "%{$search}%");
            })
            ->when($filters['equipment_id'] ?? null, fn ($query, string $equipmentId) => $query->where('equipment_id', $equipmentId))
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($filters['date_from'] ?? null, fn ($query, string $dateFrom) => $query->whereDate('maintenance_date', '>=', $dateFrom))
            ->when($filters['date_to'] ?? null, fn ($query, string $dateTo) => $query->whereDate('maintenance_date', '<=', $dateTo))
            ->latest('maintenance_date')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('maintenances.index', [
            'maintenances' => $maintenances,
            'equipments' => $this->equipmentOptions(),
            'statuses' => Maintenance::statuses(),
            'filters' => $filters,
        ]);
    }

    public function create(): View
    {
        return view('maintenances.create', [
            'maintenance' => new Maintenance([
                'status' => Maintenance::STATUS_OPEN,
                'maintenance_date' => now(),
            ]),
            'equipments' => $this->equipmentOptions(),
            'statuses' => Maintenance::statuses(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $validated['user_id'] = $request->user()->id;

        $maintenance = Maintenance::create($validated);

        return redirect()
            ->route('maintenances.show', $maintenance)
            ->with('success', 'Manutenção criada com sucesso.');
    }

    public function show(Maintenance $maintenance): View
    {
        return view('maintenances.show', [
            'maintenance' => $maintenance->load(['equipment.category', 'equipment.brand', 'equipment.sector', 'user']),
        ]);
    }

    public function edit(Maintenance $maintenance): View
    {
        return view('maintenances.edit', [
            'maintenance' => $maintenance,
            'equipments' => $this->equipmentOptions(),
            'statuses' => Maintenance::statuses(),
        ]);
    }

    public function update(Request $request, Maintenance $maintenance): RedirectResponse
    {
        $maintenance->update($this->validatedData($request));

        return redirect()
            ->route('maintenances.show', $maintenance)
            ->with('success', 'Manutenção atualizada com sucesso.');
    }

    public function destroy(Maintenance $maintenance): RedirectResponse
    {
        $maintenance->delete();

        return redirect()
            ->route('maintenances.index')
            ->with('success', 'Manutenção excluída com sucesso.');
    }

    private function equipmentOptions()
    {
        return Equipment::query()
            ->orderBy('name')
            ->orderBy('asset_number')
            ->get();
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'equipment_id' => ['required', 'integer', 'exists:equipments,id'],
            'maintenance_type' => ['required', 'string', 'max:255'],
            'problem_description' => ['required', 'string', 'max:2000'],
            'solution_description' => ['nullable', 'string', 'max:2000'],
            'maintenance_date' => ['required', 'date'],
            'estimated_cost' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'string', Rule::in(array_keys(Maintenance::statuses()))],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
