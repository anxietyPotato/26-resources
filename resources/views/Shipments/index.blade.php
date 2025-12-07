@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@extends('layout')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Shipments</h2>

        <div class="row">
            @forelse($shipments as $shipment)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $shipment->title }}</h5>
                            <p class="card-text">
                                <strong>Price:</strong> ${{ $shipment->price }}
                            </p>
                            <p class="card-text">
                                <strong>Status:</strong> {{ $shipment->status}}
                            </p>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No shipments found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
