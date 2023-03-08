<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'app_id',
        'language',
        'os',
        'client_token'
    ];
    
    public function generateClientToken()
    {
        $this->client_token = bin2hex(random_bytes(32));
        $this->save();
        return $this->client_token;
    }
}
