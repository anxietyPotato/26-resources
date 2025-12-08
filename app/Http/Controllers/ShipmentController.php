<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocs;
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

        $shipment = Shipment::create($data);

        $fileTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if (str_starts_with($file->getMimeType(), 'image/')) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;

                    $path = $file->storeAs("images/{$shipment->id}", $filename, 'public');

                    ShipmentDocs::create([
                        'shipment_id' => $shipment->id,
                        'doc_name' => str_replace('images/', '', $path),
                    ]);
                } elseif (in_array($file->getMimeType(), $fileTypes)) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;

                    $path = $file->storeAs("documents/{$shipment->id}", $filename, 'public');
                    $path = str_replace('documents/', '', $path);

                    ShipmentDocs::create([
                        'shipment_id' => $shipment->id,
                        'doc_name' => $path,
                    ]);
                }
            }
        }

        Cache::forget('unassigned_shipments'); // clear cache so new shipment shows

        return redirect()
            ->route('shipments.index')
            ->with('success', 'Shipment created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
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
