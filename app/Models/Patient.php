<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'password',
        'next_visit',
        'fb_name',
        'phone_number',
        'gender'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function record()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function billing()
    {
        return $this->hasMany(Billing::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getFirstInitialAttribute()
    {
        return substr($this->first_name, 0, 1);
    }

    public function getFirstNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getLastNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    public function getGenderAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
