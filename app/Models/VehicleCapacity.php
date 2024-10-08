<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleCapacity extends Model
{
    use HasFactory;

    protected $fillable = [
        'length', 'weight', 'height', 'width', 'gvwr', 'vehicle_id', 'created_at', 'updated_at'
    ];

    public function vehicle(): BelongsTo
    {
        return  $this->belongsTo(Vehicle::class);
    }
}
