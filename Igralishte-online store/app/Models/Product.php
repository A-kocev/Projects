<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable =[
        'name',
        'description',
        'quantity',
        'price',
        'size_hint',
        'maintenance_guidelines',
        'brand_id',
        'category_id',
        'discount_id',
        'status'
    ];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function sizes(){
        return $this->belongsToMany(Size::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function colors(){
        return $this->belongsToMany(Color::class);
    }
}