<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $totalEquipments = Equipment::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalSectors = Sector::count();
        $totalMaintenances = Maintenance::count();
        $openMaintenances = Maintenance::where('status', Maintenance::STATUS_OPEN)->count();
        $completedMaintenances = Maintenance::where('status', Maintenance::STATUS_COMPLETED)->count();

        return response()->json([
            'total_equipments' => $totalEquipments,
            'total_categories' => $totalCategories,
            'total_brands' => $totalBrands,
            'total_sectors' => $totalSectors,
            'total_maintenances' => $totalMaintenances,
            'open_maintenances' => $openMaintenances,
            'completed_maintenances' => $completedMaintenances,
        ]);
    }
}
