<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = [
        'damage_number',
        'policy_number',
        'status',
    ];
    public function policy()
    {
        return $this->hasOne(Policy::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Policy::class);
    }
}
