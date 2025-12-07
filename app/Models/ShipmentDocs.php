<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentDocs extends Model
{
    protected $fillable = ['shipment_id', 'doc_name'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
