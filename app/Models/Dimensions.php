<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function dimensionvalue(){
        return $this->hasMany(Dimensionvalues::class);
    }
}
