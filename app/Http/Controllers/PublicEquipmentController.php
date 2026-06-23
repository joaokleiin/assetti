<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublicEquipmentController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
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
            ->when($filters['category_id'] ?? null, fn ($query, int $categoryId) => $query->where('category_id', $categoryId))
            ->when($filters['brand_id'] ?? null, fn ($query, int $brandId) => $query->where('brand_id', $brandId))
            ->when($filters['sector_id'] ?? null, fn ($query, int $sectorId) => $query->where('sector_id', $sectorId))
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.equipments.index', [
            'equipments' => $equipments,
            'categories' => Category::query()->orderBy('name')->get(),
            'brands' => Brand::query()->orderBy('name')->get(),
            'sectors' => Sector::query()->orderBy('name')->get(),
            'statuses' => Equipment::statuses(),
            'filters' => $filters,
        ]);
    }

    public function show(Equipment $equipment): View
    {
        $equipment->load(['category', 'brand', 'sector']);

        $maintenances = $equipment->maintenances()
            ->with('user')
            ->latest('maintenance_date')
            ->latest()
            ->get();

        return view('public.equipments.show', [
            'equipment' => $equipment,
            'maintenances' => $maintenances,
        ]);
    }
}
