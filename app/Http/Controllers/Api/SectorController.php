<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
{
    return response()->json(
        \App\Models\Sector::orderBy('name')->get()
    );
}
}
