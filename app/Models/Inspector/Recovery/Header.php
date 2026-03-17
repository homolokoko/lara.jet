<?php

namespace App\Models\Inspector\Recovery;

use App\Http\Controllers\Library\GarmentDetectQrCode;
use App\Models\Configure\Buyers;
use App\Models\Configure\Styles;
use App\Models\GarmentTracking;
use App\Models\Configure\IdentityCard;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspector\Endline\Item;
use App\Models\Report\IdentityCard\LocateMonitor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Monitor\QrcodeLocateController;

use App\Models\GarmentTracking\Module\Recovery as RecoveryGarmentCode;
use App\Models\GarmentTracking\Main as GarmentCode;

class Header extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table = "recovery_header";
    protected $fillable = [
        'identity_card',
        'module',
        'is_resolved',
        'is_dispose',
        'is_receive',
        'is_send',
        'close_case',
        'signature'
    ];
    public $appends = ['CaseNo', 'Status', 'defect','defects','receive_when'];

    function getStatusAttribute()
    {
        if ($this->close_case) {
            return 'case_close';
        }
        if ($this->is_resolved) {
            return 'resolve';
        }
        if ($this->is_dispose) {
            return 'dispose';
        }
        if ($this->is_send) {
            return 'send back';
        }
        if ($this->is_receive) {
            return 'receive';
        }
    }

    function endline()
    {
        return $this->hasOne(Endline::class, 'header_id');
    }
    function inlinePacking()
    {
        return $this->hasOne(InlinePacking::class, 'header_id');
    }
    function afterWash()
    {
        return $this->hasOne(AfterWash::class, 'header_id');
    }
    function transaction()
    {
        return $this->hasMany(Transaction::class, 'header_id');
    }
    function ScopeReceive($q)
    {
        return $q->where(['is_receive' => true]);
    }

    function ScopeCloseCase($q, bool $v)
    {
        return $q->where(['close_case' => $v]);
    }
    function ScopePendingRepair($q)
    {
        return $q->where(['is_receive' => true, 'close_case' => false, 'is_send' => false]);
    }
    function ScopeSend($q)
    {
        return $q->where(['is_send' => true]);
    }
    function ScopePendingApprove($q)
    {
        return $q->where(['is_receive' => true, 'close_case' => false, 'is_send' => true]);
    }
    function ScopeDispose($q)
    {
        return $q->where(['is_dispose' => true]);
    }
    function ScopeResolve($q)
    {
        return $q->where(['is_resolved' => true]);
    }
    function ScopeQrcode($q, $value)
    {
        return $q->where(['identity_card' => $value]);
    }
    function getCaseNoAttribute()
    {
        return md5($this->signature);
    }

    function getReceiveWhenAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function endlineRepair()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->endline(),
                (new Endline)->endlineRepair()
            );
    }

    function style()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->endline(),
                (new Endline)->style()
            );
    }

    function buyer()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->style(),
                (new Styles)->buyer()
            );
    }
    function getDefectAttribute()
    {
        if ($this->identity_card)
            return (new QrcodeLocateController)->get($this->identity_card);
    }

    function qrCodeMonitor()
    {
        return $this->hasOne(LocateMonitor::class, 'identity_card_id', 'identity_card');
    }

    public function garmentTrackingRecovery()
    {
        return $this
            ->hasOne(
                RecoveryGarmentCode::class,
                'recovery_header_id','id'
            );
    }

    public function garmentTracking()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->garmentTrackingRecovery(),
                (new RecoveryGarmentCode)->garment()
            );
    }

    public function getDefectsAttribute()
    {
        if(!$this->garmentTracking)
            return "No Data";
        return GarmentDetectQrCode::garmentTicket($this->garmentTracking->garmentQrCode);
    }
}
