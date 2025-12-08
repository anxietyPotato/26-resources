@extends('layout')

@section('content')
<div >
    {{$shipment->from_city}}
    {{$shipment->to_city}}
</div>
@if($shipment->documents && $shipment->documents->count())
    @foreach($shipment->documents as $document)
        <a target="_blank" href="{{ asset('storage/documents/' . $document->doc_name) }}">
            {{ $document->doc_name }}
        </a>
    @endforeach
@else
    <p>No documents found.</p>
@endif
@endsection
