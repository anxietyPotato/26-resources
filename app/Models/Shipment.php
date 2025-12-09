<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Shipment extends Model
{
use HasFactory;

    const STATUS_UNASSIGNED = 'unassigned';
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_PROBLEM = 'problem';


    protected $fillable = [
        'title',
        'from_city',
        'from_country',
        'to_city',
        'to_country',
        'price',
        'status',
        'user_id',
        'details',
    ];


    public static function booted()
    {
       static::created(function ($shipment){


           if($shipment->status === self::STATUS_UNASSIGNED){
               Cache::forget('unassigned-shipments');
           }

       });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function validStatuses(): array
    {
        return [
            self::STATUS_UNASSIGNED,
            self::STATUS_PENDING,
            self::STATUS_IN_PROGRESS,
            self::STATUS_PROBLEM,
        ];
    }

    public function setStatusAttribute($status){
        if(!in_array($status, self::validStatuses())){
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->attributes['status'] = $status;
    }

    public function documents()
    {
        return $this->hasMany(ShipmentDocs::class);
    }
}

