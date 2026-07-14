<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Booking extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'booking_date',
        'booking_time',
        'status',
        'cancelled_at',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
