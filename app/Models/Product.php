<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function view_kategori(){
        return $this->belongsTo('App\Models\Categories', 'categories_id', 'id');
    }
    public function view_merek(){
        return $this->belongsTo('App\Models\Brands', 'brands_id', 'id');
    }
}
