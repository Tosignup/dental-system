<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'proc_name',
        'proc_cost',
    ];

    public function billing()
    {
        return $this->hasMany(Billing::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
