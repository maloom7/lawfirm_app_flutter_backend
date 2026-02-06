<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MatterInvoice;
use App\Models\MatterDocument;


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

    // نوع القضية
    public function type()
    {
        return $this->belongsTo(MatterType::class, 'matter_type_id');
    }

    // حالة القضية
    public function status()
    {
        return $this->belongsTo(MatterStatus::class, 'matter_status_id');
    }

    // أطراف القضية
    public function parties()
    {
        return $this->hasMany(MatterParty::class);
    }

    // المستندات
    public function documents()
    {
        return $this->hasMany(MatterDocument::class);
    }

    // الجلسات
    public function sessions()
    {
        return $this->hasMany(MatterSession::class);
    }

    // الفواتير
    public function invoices()
    {
        return $this->hasMany(MatterInvoice::class);
    }

    // من أنشأ القضية
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
}
