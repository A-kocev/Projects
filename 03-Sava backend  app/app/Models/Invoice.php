<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'due_date',
        'payment_method',
        'status'
    ];

    public function policies(){
        return $this->hasMany(Policy::class);
    }
    public function user()
    {
        return $this->hasOneThrough(User::class, Policy::class, 'invoice_id', 'id', 'id', 'user_id');
    }
}
