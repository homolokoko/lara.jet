<?php

namespace Modules\ProcessQCModule\Entities\Inspection\GarmentTracking;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking_transactions';
    protected $fillable = ['module','garment_tracking_id','is_pass','locate','inspector'];
    public $appends = ['scan_date'];

    public function garment()
    {
        return $this
            ->belongsTo(
                RootEntity::class,
                'garment_tracking_id'
            );
    }

    public function inspector()
    {
        return $this
            ->belongsTo(
                User::class,
                'inspector'
            );
    }

    public function getScanDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F, jS,y');
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\GarmentTracking\TransactionEntityFactory::new();
    }
}
