<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'recipient_id',
        'donor_date',
        'blood_count'
        ];
        public function donor()
        {
            return $this->belongsTo(Donor::class,'donor_id');
        }
        public function recipient()
        {
            return $this->belongsTo(Recipient::class,'recipient_id');
        }}
