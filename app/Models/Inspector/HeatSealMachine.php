<?php

namespace App\Models\Inspector;

use App\Models\Configure\Buyers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

use App\Models\Inspector\FusingMachine\MSerialNumber;
use App\Models\Customer;
use App\Models\Configure\Styles;
use App\Models\Configure\WorkstationLocate;

class HeatSealMachine extends Model
{
    use HasFactory;
    protected $table = 'heat_seal_machine';
    protected $primaryKey = 'id';
    protected $fillable = [
        'style_id',
        'serial_number_id',
        'customer_id',
        'line_id',
        'timing_id',
        'temperature',
        'pressure',
        'status',
        'user_id',
        'officer_id',
        'comment',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyers::class, 'customer_id');
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }

    public function serialNumber(): BelongsTo
    {
        return $this->belongsTo(MSerialNumber::class, 'serial_number_id');
    }

    public function locate(): BelongsTo
    {
        return $this->belongsTo(WorkstationLocate::class, 'line_id');
    }

    public function given()
    {
        return $this
            ->hasOne(
                HeatSealMachine\Given::class,
                'heat_seal_machine_id', 'id'
            );
    }

    public function actual()
    {
        return $this
            ->hasOne(
                HeatSealMachine\Actual::class,
                'heat_seal_machine_id', 'id'
            );
    }

}
