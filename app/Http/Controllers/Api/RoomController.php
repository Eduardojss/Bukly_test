<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 12);
        $rooms = Room::with('hotel')->where('active', 1)->paginate($perPage);

        return response()->json([
            'message' => 'ok',
            'data' => $rooms->items(),
            'meta' => [
                'itemsPerPage' => $rooms->perPage(),
                'actualPage' => $rooms->currentPage(),
                'lastPage' => $rooms->lastPage(),
                'total' => $rooms->total(),
                'nextPage' => $rooms->nextPageUrl()
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $hotel_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|sometimes',
        ]);

        $validatedData['hotel_id'] = $hotel_id;

        try {
            DB::beginTransaction();
            $room = Room::create($validatedData);
            DB::commit();

            return response()->json([
                'message' => 'ok',
                'data' => $room
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occoured trying to save the room data',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Please insert a valid identifier for a room'
            ], 400);
        }
        $user = Auth::user();
        try {
            $room = Room::join('hotels', 'rooms.hotel_id', '=', 'hotels.id')->where('active', 1)->where('hotels.user_id', $user->id)->first($id);

            return response()->json([
                'message' => 'ok',
                'data' => $room
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occoured trying to search for room data',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Please insert a valid identifier for rooms'
            ], 400);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|sometimes',
        ]);

        try {
            DB::beginTransaction();
            $room = Room::where('active', 1)->first($id);
            $room->update($validatedData);
            $room->save();
            DB::commit();

            return response()->json([
                'message' => 'ok',
                'data' => $room
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occoured trying to save the room data',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Please insert a valid identifier for rooms'
            ], 400);
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $room = Room::join('hotels', 'rooms.hotel_id', '=', 'hotels.id')->where('hotels.user_id', $user->id)->where('rooms.id', $id)->first();
            $room->update(['active' => 0]);
            DB::commit();
            return response()->json([
                'message' => 'Sucessfully deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occoured trying to search for room data',
            ], 500);
        }
    }
}
