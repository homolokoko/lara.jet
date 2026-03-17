<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Fabric\Type;
use App\Models\Configure\FabricType;
use App\Models\Configure\Measure\Profile\Header as MeasureProfile;
use App\Models\Configure\PurchaseOrders;
use App\Models\Inspector\Cutting\Panel As CuttingPanel;
use App\Models\Configure\Styles;
use App\Models\Configure\Workstations;
use App\Models\Inspector\Cutting\PurchaseOrder as CuttingPurchaseOrder;
use App\Models\Inspector\Cutting\CheckList\Checkpoint as CheckListCheckpoint;
use App\Models\Inspector\Cutting\CheckList\Defectpoint as ChecklistDefect;
use App\Models\Inspector\Cutting\Binaudit\Header as cabinAuditHeader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Traits\CuttingUserLogEvent;
class Header extends Model
{
    use CuttingUserLogEvent;

    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use SoftDeletes;
    public $table="cutting_header";

    protected static function boot()
    {
        parent::boot();

        // Hook into the created event
        static::created(function ($model) {
            $id = $model->id;
            $model->afterCreate($id);
        });

        // Hook into the updated event
        static::updated(function ($model) {
            $id = $model->id;
            $model->afterUpdate($id);
        });

        // Hook into the saved event (applies to both create and update)
        static::saved(function ($model) {
            $id = $model->id;
            $model->afterSave($id);
        });
    }

    /**
     * @var mixed
     */

    protected $fillable = [
        'doc_no','style_id','cut_lot_no',
        'workstation_id','piece_in_lay',
        'no_bin_per_lay','should_checked_bin',
        'checked_bin','wrong_point','correct_point','total_point',
        'fabric_type_id',
        'is_checklist_complete','is_cutpanel_complete','is_cabinaudit_complete',
        'wrong_point_rate','is_pass',
        'is_complete'
    ];
    protected $sequences = ['no'];
    protected $dates = ['deleted_at'];
    protected $appends = ['progress'];

    public function shrinkage(){
        return $this->hasOne(Shrinkage::class,'header_id','id');
    }
    public function style(){
        return $this->belongsTo(Styles::class,'style_id');
    }
    public function workstation(){
        return $this->belongsTo(Workstations::class,"workstation_id");
    }
    public function purchaseOrder(){
        return $this->hasMany(PurchaseOrder::class,'cutting_header_id');
    }
    public function fabricType(){
        return $this->belongsTo(FabricType::class,'fabric_type_id');
    }
    public function checklistCheckpoint(){
        return $this->hasMany(CheckList\Checkpoint::class,'cutting_header_id');
    }

    public function checklistDefect(){
        return $this->hasMany(ChecklistDefect::class,'cutting_header_id');
    }
    public function cutPanel(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            CuttingPanel::class,'cutting_header_id'
        );
    }
    public function cutPanelByStyle(){
        return $this->hasManyDeepFromRelations(
          $this->style(),
            (new Styles())->cuttingPanelName()
        );
    }

    function styleWithSize()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->profileSize()
        );
    }
    public function measurement()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->measureProfile()
        );
    }
    public function measurementProfile()
    {
        return $this->hasManyDeepFromRelations(
            $this->measurement(),
            (new MeasureProfile())->version()
        );
    }
    public function hasInspector(){
        return $this->hasMany(UserInvolved::class, 'header_id');
    }
    public function inspectorList(): \Staudenmeir\EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->hasInspector(),
            (new UserInvolved())->inspector()
        );
    }


    public function checkpoint()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->measureCheckPoint()
        );
    }
    public function cutPanelMeasure()
    {
        return $this->hasMany(
            'App\Models\Inspector\Cutting\Measure\Header',
            'cutting_header_id');
    }

    public function binAudit()
    {
        return $this->hasMany(
            'App\Models\Inspector\Cutting\Binaudit\Header',
            'cutting_header_id'
        );
    }


    public function recapCabinAudit(){
        return $this->hasManyDeepFromRelations(
            $this->recap(), (new recap)->cabinAudit()
        );
    }
    public function recap(){
        return $this->hasMany(Recap::class,'cutting_header_id');
    }
    public function recapCheckList(){
        return $this->recap()->checkList();
    }
    public function recapCabinAuditList(){
        return $this->recap()->binAuditList();
    }
    public function recapCutPanelList(){
        return $this->recap()->cutPanelList();
    }
    public function recapCheckPoint(){
        return $this->hasManyDeepFromRelations(
            $this->recap(), (new recap)->checkPoint()
        );
    }
    public function recapCheckListDefect()
    {
        return $this->hasManyDeepFromRelations(
            $this->recap(), (new recap)->defects()
        );
    }
    public function rate(){
        return $this->hasOneDeepFromRelations(
            $this->style(),(new styles)->cuttingRate()
        );
    }
    public function scopeComplete($q){
        return $q->where(['is_complete'=>1]);
    }
    public function scopeStyle($q,$style){
        return $q->where(['style_id'=>$style]);
    }
    public function scopeIncomplete($q,$style,$workstation){
        return $q->where(['style_id'=>$style,'workstation_id'=>$workstation,'is_complete'=>0]);
    }
    public function scopeToday($q){
        return $q->whereDate('created_at', Carbon::today());
    }
    public function getCutLotNoAttribute($value){
        $cutLotNo = trim($value);
        return $cutLotNo;
    }
    public function getProgressAttribute()
    {
        // is_cutpanel_complete is_cabinaudit_complete
        if($this->is_checklist_complete == 0){
            return 'spreading';
        }else if($this->is_cutpanel_complete == 0){
            return 'panelMeasurement';
        }else if($this->is_cabinaudit_complete == 0){
            return 'binAudit';
        }else{
            return 'complete';
        }
    }
    public function purchaseOrderNumber(){
        return $this->hasManyDeepFromRelations(
            $this->purchaseOrder(), (new purchaseOrder)->purchaseOrderNumber()
        );
    }
    public function getFullReportRelation(){
        return [
            'inspectorList',
            'style',
            'workstation',
            'purchaseOrderNumber',
            'fabricType',
            'recapCheckList.log',
            'recapCabinAuditList.log',
            'recapCabinAuditList.cabinAudit.headers',
            'recapCabinAuditList.cabinAudit.checkpoint',
            'recapCheckPoint',
            'cutPanelByStyle',
            'checklistCheckpoint.checkpoint',
            'style.profileSize',
            'styleWithSize',
            'checkpoint',
            'cutPanel.size',
            'cutPanel.panel',
            'cutPanel.image',
            'cutPanel.recap',
            'cutPanel.recap.defectsName',
            'cutPanel.recap.causeName',
            'cutPanel.recap.log',
            'cutPanelMeasure.checkpoint.checkpointSize.sizeRecord',
            'cutPanelMeasure.checkpoint.name',
            'cutPanelMeasure.checkpoint.checkpointSize.name',
            'cutPanelMeasure.panelName',
            'cutPanelMeasure.patternMeasure',
            'binAudit.details.checkpoint.translation',
            'shrinkage'
        ];
    }
    public function scopeGetExisting($query, $arr)
    {
        $query->with(self::getFullReportRelation())->where([
        'style_id' => Arr::get($arr,'style'),
        'cut_lot_no' => Arr::get($arr,'cutLotNo'),
        'workstation_id' => Arr::get($arr,'workstation')
        ]);
    }

    public function scopeGetFullReport($query,$headerId){

        return $query->with(self::getFullReportRelation())->where(['id'=>$headerId]);
    }

    public function scopeGetTrash($q){
        return $q->withTrashed();
    }


    /*public function purchaseOrder(){
        return $this->hasManyThrough(
            CuttingPurchaseOrder::class,
            PurchaseOrders::class,
            );
    }*/


}
