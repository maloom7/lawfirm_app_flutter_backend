<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterSession extends Model
{
    protected $fillable = [
        'matter_id',
        'session_date',
        'court',
        'circuit',
        'session_type',
        'assigned_lawyer_id',
        'result',
        'next_action',
        'notes',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function assignedLawyer()
    {
        return $this->belongsTo(User::class, 'assigned_lawyer_id');
    }
}
