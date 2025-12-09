@foreach($shipment->documents as $document)
    @php
        $fullPath = $document->doc_name;   // store() already saves full path
    @endphp

    @if(Storage::disk('public')->exists($fullPath))
        <a target="_blank" href="{{ asset('storage/' . $fullPath) }}">
            {{ basename($document->doc_name) }}
        </a>
    @else
        <p>Document not found or inaccessible.</p>
    @endif
@endforeach
