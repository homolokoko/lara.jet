<?php

namespace App\Models\Configure\PSC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vicklr\MaterializedModel\MaterializedModel;

class Listed extends MaterializedModel
{
    use HasFactory;
    protected $table = 'psc_list';
    protected $fillable = [
        'psc_checkpoint_id', 'parent_id', 'weight', 'depth', 'path','version'
    ];

    protected string $orderColumn = "weight";
    protected $guarded = array('id', 'parent_id', 'depth', 'path', 'weight');
    public $timestamps = false;
    protected $casts = [
        'parent_id' => 'integer',
    ];

    public function checkpoint(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CheckList::class, 'psc_checkpoint_id');
    }

}
