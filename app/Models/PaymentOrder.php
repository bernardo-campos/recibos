<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'date',
        'date_string',
        'to_id',
        'invoice_number',
        'establishment_id',
        'concept_id',
        'currency_id',
        'amount_total',
        'amount_total_words',
        'type',
        'account_id',
        'note',
        'created_by',
    ];


    protected $casts = [
        'date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(array_merge(
                $this->fillable,
                ['to','concept', $this->account->id ? 'account' : '']
            ))
            ->logOnlyDirty();
    }

    function to()
    {
        return $this->belongsTo(To::class);
    }

    function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    function account()
    {
        // ???
        return $this->belongsTo(Account::class)->withDefault([
            'bank' => new Bank()
        ]);
    }

    function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
