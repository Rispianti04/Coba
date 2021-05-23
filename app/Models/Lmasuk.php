<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lmasuk extends Model
{
    use HasFactory;
    public function view_product(){
        return $this->belongsTo('App\Models\Product', 'products_id', 'id');
    }
}
