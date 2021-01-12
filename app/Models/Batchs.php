<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batchs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'active',
        'expirydatetime',
    ];

    public function price(){
        return $this->hasMany(Prices::class);
    }

    public function dimension(){
        return $this->hasMany(Dimensions::class);
    }
}
