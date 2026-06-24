<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
{
    return response()->json(
        \App\Models\Brand::orderBy('name')->get()
    );
}
}
