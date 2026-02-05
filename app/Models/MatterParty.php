<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterParty extends Model
{
    protected $fillable = [
        'matter_id',
        'party_type',
        'name',
        'national_id',
        'phone',
        'address',
        'notes',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }
}

