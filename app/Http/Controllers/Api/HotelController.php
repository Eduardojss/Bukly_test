<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $hotels = Hotel::paginate($perPage);

        return response()->json([
            'message' => 'ok',
            'data' => $hotels->items(),
            'meta' => [
                'itemsPerPage' => $hotels->perPage(),
                'actualPage' => $hotels->currentPage(),
                'lastPage' => $hotels->lastPage(),
                'total' => $hotels->total(),
                'nextPage' => $hotels->nextPageUrl()
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:hotels,name',
            'address' => 'required|text',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'website' => 'required|sometimes|text'
        ]);

        try{
            DB::beginTransaction();
            $hotel = Hotel::create($validatedData);
            DB::commit();

            return response()->json([
                'message' => 'ok',
                'data' => $hotel
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => 'An error occoured trying to save the hotel data',
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
                'message' => 'Please insert a valid identifier for hotels'
            ], 400);
        }

        try{
            $hotel = Hotel::where('id', $id)->first();

            return response()->json([
                'message' => 'ok',
                'data' => $hotel
            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occoured trying to search for hotel data',
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
        if(!$id){
            return response()->json([
                'message' => 'Please insert a valid identifier for hotels'
            ], 400);
        }

        $validatedData = $request->validate([
            'name' => 'required|sometimes|string|unique:hotels,name',
            'address' => 'required|sometimes|text',
            'city' => 'required|sometimes|string',
            'state' => 'required|sometimes|string',
            'zip_code' => 'required|sometimes|string',
            'website' => 'required|sometimes|text'
        ]);

        try {
            DB::beginTransaction();
            $hotel = Hotel::find($id);
            $hotel->update($validatedData);
            $hotel->save();
            DB::commit();

            return response()->json([
                'message' => 'ok',
                'data' => $hotel
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occoured trying to save the hotel data',
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
                'message' => 'Please insert a valid identifier for hotels'
            ], 400);
        }

        try {
            $hotel = Hotel::where('id', $id)->first();
            $hotel->delete();
            $hotel->save();
            return response()->json([
                'message' => 'Sucessfully deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occoured trying to search for hotel data',
            ], 500);
        }
    }
}
