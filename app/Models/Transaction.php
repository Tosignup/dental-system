<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'transaction_date',
        'transaction_status',
    ];

    public function patient()
    {
        return this->belongsTo(Patient::class);
    }

    public function billing()
    {
        return this->belongsTo(Billing::class);
    }

}
