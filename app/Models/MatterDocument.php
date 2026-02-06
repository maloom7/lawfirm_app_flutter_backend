<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterDocument extends Model
{
    protected $fillable = [
        'matter_id',
        'uploaded_by',
        'type',
        'title',
        'file_path',
        'extension',
        'upload_date',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
