<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalEquipments = Schema::hasTable('equipments') ? Equipment::count() : 0;
        $totalCategories = Schema::hasTable('categories') ? Category::count() : 0;
        $totalSectors = Schema::hasTable('sectors') ? Sector::count() : 0;
        $totalMaintenances = Schema::hasTable('maintenances') ? Maintenance::count() : 0;

        return view('public.home', compact(
            'totalEquipments',
            'totalCategories',
            'totalSectors',
            'totalMaintenances'
        ));
    }
}
