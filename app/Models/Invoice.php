<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'billable_id', 'billable_type',
        'client_id', 'created_by',
        'invoice_number', 'amount', 'paid',
        'due_date', 'payment_date', 'status', 'description'
    ];

    // علاقة الفاتورة مع الجهة (قضية - عقد - معاملة - إلخ)
    public function billable()
    {
        return $this->morphTo();
    }

    // العميل صاحب الفاتورة
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // الموظف / المحامي المنشئ
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // المدفوعات الخاصة بالفاتورة
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // هل الفاتورة مدفوعة بالكامل؟
    public function isPaid()
    {
        return $this->amount <= $this->paid;
    }
}
