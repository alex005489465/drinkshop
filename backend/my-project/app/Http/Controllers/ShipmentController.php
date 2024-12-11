<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Shipment::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shipment = Shipment::create($request->all());
        return response()->json($shipment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shipment = Shipment::find($id);
        
        if (is_null($shipment)) {
            return response()->json(['message' => 'Shipment not found'], 404);
        }
        
        return response()->json($shipment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::find($id);
        
        if (is_null($shipment)) {
            return response()->json(['message' => 'Shipment not found'], 404);
        }

        $shipment->update($request->all());
        return response()->json($shipment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipment = Shipment::find($id);
        
        if (is_null($shipment)) {
            return response()->json(['message' => 'Shipment not found'], 404);
        }

        $shipment->delete();
        return response()->json(['message' => 'Shipment deleted'], 204);
    }
}
