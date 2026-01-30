<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterStatus extends Model
{
    protected $fillable = ['name', 'code', 'is_final'];

    public function matters()
    {
        return $this->hasMany(Matter::class);
    }

    
}
