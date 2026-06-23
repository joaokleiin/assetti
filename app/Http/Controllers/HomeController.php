<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the public home page with statistics and recent data.
     *
     * This method retrieves:
     * - Total count of equipments, categories, sectors, and maintenances
     * - 6 most recent equipments with eager-loaded categories
     * - 5 most recent maintenances with eager-loaded equipment
     *
     * All queries are optimized to prevent N+1 problems.
     */
    public function index(): View
    {
        // Retrieve total counts for statistics cards
        $totalEquipments = Equipment::query()->count();
        $totalCategories = Category::query()->count();
        $totalSectors = Sector::query()->count();
        $totalMaintenances = Maintenance::query()->count();

        // Retrieve 6 most recent equipments with eager-loaded category
        $recentEquipments = Equipment::query()
            ->select(['id', 'name', 'asset_number', 'category_id', 'status', 'created_at'])
            ->with(['category:id,name'])
            ->latest()
            ->limit(6)
            ->get();

        // Retrieve 5 most recent maintenances by maintenance_date with eager-loaded equipment
        $recentMaintenances = Maintenance::query()
            ->select(['id', 'equipment_id', 'maintenance_type', 'maintenance_date', 'status', 'created_at'])
            ->with(['equipment:id,name'])
            ->latest('maintenance_date')
            ->limit(5)
            ->get();

        return view('public.home', compact(
            'totalEquipments',
            'totalCategories',
            'totalSectors',
            'totalMaintenances',
            'recentEquipments',
            'recentMaintenances'
        ));
    }
}
