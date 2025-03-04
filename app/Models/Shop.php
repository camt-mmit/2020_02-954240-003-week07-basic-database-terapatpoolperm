<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable= ['code', 'name', 'owner', 'latitude', 'longitude', 'address'];

    function products() {

        return $this->belongsToMany(Product::class);

    }
}
