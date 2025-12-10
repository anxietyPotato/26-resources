@php use \App\Models\Shipment ; @endphp
@extends('layout')

@section('content')


    <div class="container mt-4">
        <h2 class="mb-4 bg-dark text-white p-2 rounded">Edit Shipment</h2>

        <form action="{{ route('shipments.update', $shipment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label text-info">Title</label>
                <input type="text" name="title" id="title" class="form-control border-dark"
                       value="{{ old('title', $shipment->title) ?? ''}}" required>
            </div>

            {{-- From --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="from_city" class="form-label text-info">From City</label>
                    <input type="text" name="from_city" id="from_city" class="form-control border-dark"
                           value="{{ old('from_city', $shipment->from_city) ?? '' }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="from_country" class="form-label text-info">From Country</label>
                    <input type="text" name="from_country" id="from_country" class="form-control border-dark"
                           value="{{ old('from_country', $shipment->from_country ?? 'USA') }}" required>
                </div>
            </div>

            {{-- To --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="to_city" class="form-label text-info">To City</label>
                    <input type="text" name="to_city" id="to_city" class="form-control border-dark"
                           value="{{ old('to_city', $shipment->to_city) ?? ''}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="to_country" class="form-label text-info">To Country</label>
                    <input type="text" name="to_country" id="to_country" class="form-control border-dark"
                           value="{{ old('to_country', $shipment->to_country ?? 'USA') }}" required>
                </div>
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label text-info">Price ($)</label>
                <input type="number" name="price" id="price" class="form-control border-dark" min="0"
                       value="{{ old('price', $shipment->price) ?? ''}}" required>
            </div>

            @if($errors->has('user_id'))
                {{$errors->first()}}
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label text-info">Driver id</label>
                <input type="number" name="user_id" id="user_id" class="form-control border-dark" min="0"
                       value="{{ old('user_id', $shipment->user_id) ?? ''}}" required>
            </div>

            @if($errors->has('client_id'))
                <div class="text-danger">{{ $errors->first('client_id') }}</div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label text-info">Cient id</label>
                <input type="number" name="client_id" id="client_id" class="form-control border-dark" min="0"
                       value="{{ old('client_id')}}" required>


            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label for="status" class="form-label text-info">Status</label>
                <select name="status" id="status" class="form-select border-dark" required>
                    @foreach(Shipment::validStatuses() as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $shipment->status) === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Documents --}}
            <div class="mb-3">
                <label for="documents" class="form-label text-info">Upload Document Images</label>
                <input type="file" name="documents[]" id="documents" class="form-control border-dark" multiple
                       accept=".jpg,.jpeg,.png,.webp,.pdf">
                <small class="text-secondary">You can select multiple images at once (CTRL or SHIFT)</small>
            </div>

            {{-- Details --}}
            <div class="mb-3">
                <label for="details" class="form-label text-info">Details</label>
                <textarea name="details" id="details" class="form-control border-dark" rows="4">{{ old('details', $shipment->details) }}</textarea>
            </div>

            <button type="submit" class="btn btn-dark">Update Shipment</button>
        </form>
    </div>
@endsection
