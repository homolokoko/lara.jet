<?php

namespace App\Models\Configure;

use App\Models\Configure\Buyers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Inspector\FusingMachine\MSerialNumber;

use App\Models\Customer;
use App\Models\Configure\Styles;

class FusingMachine extends Model
{
    use HasFactory;

    protected $table = 'fusing_machine';
    protected $primaryKey = 'id';

    protected $fillable = [
        'machine_sr_number',
        'temperature',
        'pressure',
        // 'time_period',
        'machine_condition',
        'belt_condition',
        'status',
        'comment',
        'customer_id',
        'user_id',
        'ia_number',
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
        return $this->belongsTo(Styles::class, 'ia_number');
    }

    public function serialNumber(): BelongsTo
    {
        return $this->belongsTo(MSerialNumber::class, 'machine_sr_number');
    }
}
