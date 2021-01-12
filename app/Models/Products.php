<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function productimage(){
        return $this->hasMany(Productimages::class);
    }

    public function batch(){
        return $this->hasMany(Batchs::class);
    }
}
