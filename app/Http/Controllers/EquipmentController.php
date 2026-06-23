<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'sector_id' => ['nullable', 'integer', 'exists:sectors,id'],
            'status' => ['nullable', 'string', Rule::in(array_keys(Equipment::statuses()))],
        ]);

        $equipments = Equipment::query()
            ->with(['category', 'brand', 'sector'])
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('asset_number', 'like', "%{$search}%");
                });
            })
            ->when($filters['category_id'] ?? null, fn ($query, string $categoryId) => $query->where('category_id', $categoryId))
            ->when($filters['sector_id'] ?? null, fn ($query, string $sectorId) => $query->where('sector_id', $sectorId))
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('equipments.index', [
            'equipments' => $equipments,
            'categories' => Category::query()->orderBy('name')->get(),
            'sectors' => Sector::query()->orderBy('name')->get(),
            'statuses' => Equipment::statuses(),
            'filters' => $filters,
        ]);
    }

    public function create(): View
    {
        return view('equipments.create', [
            'equipment' => new Equipment([
                'status' => Equipment::STATUS_AVAILABLE,
            ]),
            ...$this->formOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $equipment = Equipment::create($this->validatedData($request));

        return redirect()
            ->route('equipments.show', $equipment)
            ->with('success', 'Equipamento criado com sucesso.');
    }

    public function show(Equipment $equipment): View
    {
        return view('equipments.show', [
            'equipment' => $equipment->load(['category', 'brand', 'sector']),
            'maintenances' => $equipment->maintenances()
                ->with('user')
                ->latest('maintenance_date')
                ->latest()
                ->get(),
        ]);
    }

    public function edit(Equipment $equipment): View
    {
        return view('equipments.edit', [
            'equipment' => $equipment,
            ...$this->formOptions(),
        ]);
    }

    public function update(Request $request, Equipment $equipment): RedirectResponse
    {
        $equipment->update($this->validatedData($request, $equipment));

        return redirect()
            ->route('equipments.show', $equipment)
            ->with('success', 'Equipamento atualizado com sucesso.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        $equipment->delete();

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Equipamento excluido com sucesso.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formOptions(): array
    {
        return [
            'categories' => Category::query()->orderBy('name')->get(),
            'brands' => Brand::query()->orderBy('name')->get(),
            'sectors' => Sector::query()->orderBy('name')->get(),
            'statuses' => Equipment::statuses(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Equipment $equipment = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'asset_number' => [
                'required',
                'string',
                'max:100',
                Rule::unique('equipments', 'asset_number')->ignore($equipment),
            ],
            'serial_number' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('equipments', 'serial_number')->ignore($equipment),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'sector_id' => ['required', 'integer', 'exists:sectors,id'],
            'status' => ['required', 'string', Rule::in(array_keys(Equipment::statuses()))],
            'acquisition_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
