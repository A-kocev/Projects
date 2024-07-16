<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'policy_number',
        'number_of_people',
        'start_date',
        'expiration_date',
        'price',
        'user_id',
        'active',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function damage(){
        return $this->hasOne(Damage::class);
    }
}
