<?php

namespace App\Models;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

}
