<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return inertia('Home', compact('hotels'));
    }

    public function create()
    {
        return inertia('Hotels/Create');
    }

    public function edit()
    {
        return inertia('Hotels/Edit');
    }
}
