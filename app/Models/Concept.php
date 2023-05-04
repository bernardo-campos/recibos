<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'type',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable)
            ->logOnlyDirty();
    }

    function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    function payment_orders()
    {
        return $this->hasMany(PaymentOrder::class);
    }
}
