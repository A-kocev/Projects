<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandImage extends Model
{
    use HasFactory;
    public $fillable = [
        'image_url',
        'brand_id',
    ];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
