<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $table = 'donors'; // Pastikan tabelnya benar

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'blood_type',
        'phone',
        'email',
        'weight',
        'blood_count',
        'ktp_file',
        'is_healthy',
        'has_disease_history',
        'slept_well',
    ];
    
    public function donations()
    {
        return $this->hasMany(Donation::class,'donor_id');
    }
    
}
