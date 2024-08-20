<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $table = 'dentists';

    protected $fillable = [
        'dentist_first_name',
        'dentist_last_name',
        'dentist_birth_date',
        'dentist_email',
        'dentist_password',
        'dentist_specialization',
        'dentist_schedule',
    ];

    public function user()
    {
        return $this->hasOne(LoggedUser::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
