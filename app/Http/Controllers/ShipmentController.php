<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use App\Models\ShipmentDocs;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;


class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $shipments =Cache::remember('unassigned_shipments',600,fn() =>  Shipment::UnassignedShipments()->get());
        return view('shipments.index',['shipments' =>$shipments ?? 'No shipments found']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Shipment::class);

        return view('shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShipmentRequest $request)
    {
        $this->authorize('create', Shipment::class);


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

                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;

                // IMAGE FILE
                if (str_starts_with($file->getMimeType(), 'image/')) {

                    $path = $file->storeAs(
                        "images/{$shipment->id}",
                        $filename,
                        'public'
                    );

                    ShipmentDocs::create([
                        'shipment_id' => $shipment->id,
                        'doc_name' => $path,   // save full path
                    ]);
                }

                // DOCUMENT FILE
                elseif (in_array($file->getMimeType(), $fileTypes)) {

                    $path = $file->storeAs(
                        "documents/{$shipment->id}",
                        $filename,
                        'public'
                    );

                    ShipmentDocs::create([
                        'shipment_id' => $shipment->id,
                        'doc_name' => $path,   // save full path
                    ]);
                }
            }
        }



        return redirect()
            ->route('shipments.index')
            ->with('success', 'Shipment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $this->authorize('view', $shipment);

        return view('shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        $this->authorize('update', $shipment);

        return view('shipments.edit', compact('shipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShipmentRequest $request, Shipment $shipment)
    {
        // Validate input
        $data = $request->validated();

        // Preserve user_id if nullable (uncomment if you want to reassign)
        // $data['user_id'] = auth()->id();

        // Update shipment record
        $shipment->update($data);

        $fileTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        // Handle new file uploads (optional)
        if ($request->hasFile('documents')) {
            // If you want to replace old docs:
            // $shipment->docs()->delete();

            foreach ($request->file('documents') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename  = uniqid() . '.' . $extension;

                $folder = str_starts_with($file->getMimeType(), 'image/')
                    ? "images/{$shipment->id}"
                    : (in_array($file->getMimeType(), $fileTypes)
                        ? "documents/{$shipment->id}"
                        : null);

                if ($folder) {
                    $path = $file->storeAs($folder, $filename, 'public');

                    ShipmentDocs::create([
                        'shipment_id' => $shipment->id,
                        'doc_name'    => $path,
                    ]);
                }
            }
        }

        return redirect()
            ->route('shipments.index')
            ->with('success', 'Shipment updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
    public function assignUser(Request $request,Shipment $shipment): RedirectResponse
    {
        $request->validate(['user_id' => ['required', 'exists:users,id']]);


        $shipment->user_id = $request->user_id;
        $shipment->status = Shipment::STATUS_IN_PROGRESS;
        $shipment->save();

        return redirect()->back();
    }
}
