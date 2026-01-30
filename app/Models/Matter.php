<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $fillable = [
        'matter_number',
        'title',
        'description',
        'matter_type_id',
        'matter_status_id',
        'court',
        'circuit',
        'opened_at',
        'closed_at',
        'created_by',
    ];

    public function status()
    {
        return $this->belongsTo(MatterStatus::class, 'matter_status_id');
    }
}
