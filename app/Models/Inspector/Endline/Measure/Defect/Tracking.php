<?php

namespace App\Models\Inspector\Endline\Measure\Defect;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'endline_measure_defect_tracking';

    protected $fillable = [
        'measure_defect_record_id',
        'qrcode',
        'founded_by',
        'return_by',
        'return_at',
        'founded_at',
        'is_active'
    ];
    protected $casts = [
        'return_at' => 'datetime',
        'founded_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class, 'measure_defect_record_id');
    }
    public function foundBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'founded_by', 'id');
    }
    public function returnBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'return_by', 'id');
    }
    public function actionTaken(){
        return $this->belongsTo(
            \App\Models\Supervisor\ActionTaken\EndlineMeasure\Header::class,
            'measure_defect_record_id');
    }
}
