<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'patient_id',
        'dentist_id',
        'branch_id',
        'proc_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
