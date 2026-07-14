<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\DoctorSchedule;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'specialty_id',
        'name',
        'email',
        'password',
        'bio',
        'photo',
    ];

    protected $hidden = [
        'password',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}