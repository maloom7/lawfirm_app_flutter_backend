<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    public function invoices()
{
    return $this->morphMany(Invoice::class, 'billable');
}

}
