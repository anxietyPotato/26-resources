@php use \App\Models\Shipment ; @endphp

@extends('layout')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="container mt-4">
        <h2 class="mb-4">Create Shipment</h2>

        <form action="{{ route('shipments.store') }}"  enctype="multipart/form-data" method="POST" >
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="from_city" class="form-label">From City</label>
                    <input type="text" name="from_city" id="from_city" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="from_country" class="form-label">From Country</label>
                    <input type="text" name="from_country" id="from_country" class="form-control" value="USA" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="to_city" class="form-label">To City</label>
                    <input type="text" name="to_city" id="to_city" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="to_country" class="form-label">To Country</label>
                    <input type="text" name="to_country" id="to_country" class="form-control" value="USA" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" name="price" id="price" class="form-control" min="0" required>
            </div>
            <select name="status" id="status" class="form-select" required>
                @foreach(\App\Models\Shipment::validStatuses() as $status)
                    <option value="{{ $status }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                @endforeach
            </select>

            @if($errors->has('user_id'))
                {{$errors->first()}}
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label text-info">Driver id</label>
                <input type="number" name="user_id" id="user_id" class="form-control border-dark" min="0"
                       value="{{ old('user_id') }}" required>
            </div>

            @if($errors->has('client_id'))
                <div class="text-danger">{{ $errors->first('client_id') }}</div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label text-info">Cient id</label>
                <input type="number" name="client_id" id="client_id" class="form-control border-dark" min="0"
                       value="{{ old('client_id')}}" required>


            </div>



            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="to_city" class="form-label">To City</label>
                    <input type="text" name="to_city" id="to_city" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="to_country" class="form-label">To Country</label>
                    <input type="text" name="to_country" id="to_country" class="form-control" value="USA" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="documents" class="form-label">Upload Document Images</label>
                    <input type="file" name="documents[]" id="documents" class="form-control" multiple accept=".jpg,.jpeg,.png,.webp,.pdf">
                    <small class="text-warning">You can select multiple images at once,hold CTRL (to select multiple)
                    hold SHIFT (to select range)</small>
                </div>
            </div>


            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <textarea name="details" id="details" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Shipment</button>
        </form>
    </div>
@endsection
