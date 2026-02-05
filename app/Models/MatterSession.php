<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterSession extends Model
{
    protected $fillable = [
        'matter_id',
        'session_date',
        'session_time',
        'court',
        'circuit',
        'status',
        'decision',
        'notes',
        'attended_by',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function attendee()
    {
        return $this->belongsTo(User::class, 'attended_by');
    }
}
