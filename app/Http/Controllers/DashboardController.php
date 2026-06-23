<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Maintenance;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalEquipments = Equipment::count();
        $statusCounts = Equipment::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $equipmentsInUse = $statusCounts[Equipment::STATUS_IN_USE] ?? 0;
        $equipmentsAvailable = $statusCounts[Equipment::STATUS_AVAILABLE] ?? 0;
        $equipmentsMaintenance = $statusCounts[Equipment::STATUS_MAINTENANCE] ?? 0;

        $totalMaintenances = Maintenance::count();
        $openMaintenances = Maintenance::where('status', Maintenance::STATUS_OPEN)->count();

        return view('dashboard', compact(
            'totalEquipments',
            'equipmentsInUse',
            'equipmentsAvailable',
            'equipmentsMaintenance',
            'totalMaintenances',
            'openMaintenances'
        ));
    }
}
