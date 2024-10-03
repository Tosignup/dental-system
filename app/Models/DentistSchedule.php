<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentistSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id', 
        'branch_id', 
        'date', 
        'start_time', 
        'end_time', 
        'appointment_duration',
    ];
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('d-m-Y H:i:s'); // Customize the format as needed
    // }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
