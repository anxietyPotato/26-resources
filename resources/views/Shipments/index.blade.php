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
                            <p class="card-text">
                                <strong>From city:</strong> {{ $shipment->from_city}}
                            </p>
                            <p class="card-text">
                                <strong>to city:</strong> {{ $shipment->to_city}}
                            </p>
                            <p class="card-text">
                                <strong>from country:</strong> {{ $shipment->from_country}}
                            </p>
                            <p class="card-text">
                                <strong>to country:</strong> {{ $shipment->to_country}}
                            </p>
                        </div>
                        <a href="{{ route('shipments.show', $shipment->id) }}" class="btn btn-primary">View details</a>
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
