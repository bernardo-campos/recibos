<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'date',
        'date_string',
        'from_id',
        'concept_id',
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
                ['from','concept', $this->account->id ? 'account' : '']
            ))
            ->logOnlyDirty();
    }

    function getEmailTextAttribute()
    {
        $amount = number_format($this->amount_total, 2,",",".");

        return <<<EOD
                Informamos a Uds. que se emitió el siguiente recibo:
                N° {$this->attributes['id']}: Monto \${$amount} - Concepto: {$this->concept->name}

                El mismo queda a su disposición en el casillero asignado a la Institución.
                Saludos cordiales,

                Área Contable
                EMPRESA
                EOD;
        
    }
    
    function from()
    {
        return $this->belongsTo(From::class);
    }

    function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    function account()
    {
        return $this->belongsTo(Account::class)->withDefault([
            'bank' => new Bank()
        ]);
    }

    function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
