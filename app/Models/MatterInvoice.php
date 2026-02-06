<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatterInvoice extends Model
{
    protected $fillable = [
        'matter_id',
        'created_by',
        'invoice_number',
        'amount',
        'paid',
        'due_date',
        'payment_date',
        'status',
        'description',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
