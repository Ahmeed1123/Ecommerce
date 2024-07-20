<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    const DEFAULT_CURRENCY = 'SAR';
    protected $fillable = [
        'id',
        'payment_id',
        'user_id',
        'status',
        'amount',
        'description',
        'currency',
        'company',
        'ip',
        'meta_data',
        'amount_format',
        'fee_format',
        'fee',
        'created_at',
        'transaction_number',
        'type',
    ];

    protected $hidden = [
        'ip',
        'id',
        'meta_data',
        'company',
        'fee_format',
        'amount_format',
        'amount',
        'updated_at',
        'fee',
        'created_at',
        'currency',
        'type',
        'transaction_number',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->hasMany(Order::class);

    }
    public function item() {
        return $this->hasManyThrough(Item::class , Order::class);

    }

}
