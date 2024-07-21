<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Client\Request;

class RoomController extends Controller
{
    public function create()
    {
        return inertia('Rooms/Create');
    }

    public function edit($id){
        return inertia('Rooms/Edit', ['room_id' => $id]);
    }
}
