<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt',
        'device_id',
        'status',
        'expire_date'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
