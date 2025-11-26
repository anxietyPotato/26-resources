<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $shipments =Cache::remember('unassigned_shipments',600,fn() =>  Shipment::where('status',Shipment::STATUS_UNASSIGNED)->get());
        return view('shipments.index',['shipments' =>$shipments ?? 'No shipments found']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipments.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShipmentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        Shipment::create($data);

        return redirect()->route('shipments.index')->with('success', 'Shipment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
      return view('shipments.show',['shipment' =>$shipment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
