<?php

namespace App\Models\StyleApparel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Checkpoint as RefCheckPoint;

class Checkpoint extends Model
{
    use HasFactory;

    protected $table = 'style_apparel_checkpoint';
    protected $fillable = ['style_apparel_id','checkpoint_id','number'];

    public function checkpoints()
    {
        return $this
            ->belongsTo(
                RefCheckPoint::class,
                'checkpoint_id'
            );
    }
}
