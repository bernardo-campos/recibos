<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['number','bank_id','branch'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(array_merge(
                $this->fillable, 
                ['bank']
            ))
            ->logOnlyDirty();;
    }

    function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
