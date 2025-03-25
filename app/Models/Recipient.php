<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
        'name',
        'age',
        'gender',
        'blood_type',
        'rhesus',
        'phone',
        'address',
        'required_blood_bags',
        'status',
    ];
    public function donations()
    {
        return $this->hasMany(Donation::class,'donor_id');
    }
}
