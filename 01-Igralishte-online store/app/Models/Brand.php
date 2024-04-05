<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable = [
        'name',
        'description',
        'status'
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function images(){
        return $this->hasMany(BrandImage::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
