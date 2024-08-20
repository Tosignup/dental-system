<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'proc_done',
        'date',
        'total',
    ];

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
