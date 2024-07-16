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
        'item_id',
        'status',
        'amount',
        'description',
        'currency',
        'ip',
        'fee',
        'created_at',
    ];

    protected $hidden = [
        'ip',
        'updated_at',
         'currency',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);

    }

}
