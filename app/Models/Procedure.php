<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'visit_type'
    ];

    public function billing()
    {
        return $this->hasMany(Billing::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
