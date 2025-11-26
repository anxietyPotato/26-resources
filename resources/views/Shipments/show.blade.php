@extends('layout')

@section('content')
<div >
    {{$shipment->from_city}}
    {{$shipment->to_city}}
</div>
@endsection
