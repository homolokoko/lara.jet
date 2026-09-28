<?php

namespace App\Models\Inspector\AfterWash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Style\Profile as StyleProfile;
use App\Models\Configure\Styles;
use App\Models\Configure\WorkstationLocate;
use App\Models\User;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Profile extends Model
{
    use HasFactory;
    use HasRelationships;

    public $table = 'insp_afterwash_profile';
    protected $fillable = [
        'hour', 'locates_id', 'inspected_pcs',
        'repair_pcs', 'pass_pcs', 'reject_pcs',
        'reject_rate', 'purchase_order_id', 'styles_id',
        'style_profile_id', 'inspector_id', 'report_date',
        'inspect_locate_id'
    ];
    protected $sequences = ['no'];
    protected $appends = ['weekOfYear', 'hours'];


    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class, 'insp_profile_id');
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id');
    }
    public function style()
    {
        return $this->belongsTo(Styles::class, 'styles_id');
    }
    public function styleProfile()
    {
        return  $this->belongsTo(StyleProfile::class, 'style_profile_id');
    }
    public function version()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new styleProfile())->version()
        );
    }
    public function inspectLocate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'inspect_locate_id');
    }
    public function getweekOfYearAttribute()
    {
        return [];
    }
    public function getHoursAttribute()
    {
        return [];
    }
}
