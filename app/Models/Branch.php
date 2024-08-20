<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_loc',
    ];

    public function dentists()
    {
        return $this->hasMany(Dentist::class, 'branch_id');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'branch_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'branch_id');
    }
}
