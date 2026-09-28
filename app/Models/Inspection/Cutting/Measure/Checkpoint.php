<?php

namespace App\Models\Inspector\Cutting\Measure;

use App\Models\Configure\Measure\Profile\Detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Checkpoint extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $table = "cutting_panel_measure_checkpoint";
    protected $fillable = ['checkpoint_id'];
    public $timestamps = false;

    public function checkpointSize(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            Size::class,
            'cutting_panel_measure_checkpoint_id');
    }
    public function name(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Detail::class,'checkpoint_id');
    }
    public function sizeList()
    {
        return $this->hasManyDeepFromRelations(
          $this->checkpointSize(),
            (new Size())->name()
        );
    }
    public function recordList(){
        return $this->hasManyDeepFromRelations(
            $this->checkpointSize(),
            (new Size())->sizeRecord()
        );
    }
}
