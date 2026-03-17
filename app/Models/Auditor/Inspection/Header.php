<?php

namespace App\Models\Auditor\Inspection;

use App\Http\Livewire\Transfer\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AQL\{Level,InspectionLevel};
use App\Models\Auditor\Inspection\DocType as InspectionDocType;
use App\Models\Configure\Buyers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auditor\Inspection\Measurement\Header as MeasurementHeader;
use App\Models\Auditor\Inspection\Measurement\Item;
use App\Models\Auditor\Inspection\Measurement\Chart;
use App\Models\Auditor\Inspection\Packing\Barcode\Header as PackingBarcodeHeader;
use App\Models\Auditor\Inspection\TakePhoto\Defects as TakePhotoDefects;
use App\Models\Auditor\Inspection\TakePhoto\Test  as TakePhotoTest;
use App\Models\Auditor\Inspection\TakePhoto\View  as TakePhotoView;
use App\Models\Auditor\Inspection\TakePhoto\Evaluate  as TakePhotoEvaluate;
use App\Models\Auditor\Inspection\StyleInformation;
use App\Models\Auditor\{Inspection, Inspection\CtnNPriceTag\Header as CtnNPriceTagHeader, PdfStatus, Setup};
use App\Models\User;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use App\Models\Auditor\Inspection\Carton;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use HasFactory;
    use HasRelationships;
    use SoftDeletes;

    public $table="inspection_header";

    protected $sequences = ['no'];
    protected $appends = ['docStatus','created_format'];

    /** workmanship base on Po QTY */
    /** suggestion_carton && suggest_measurement_pcs
     * base on result AQL with PO Quantity */
    public $fillable = ['no',	'buyer_id',	'doc_type',	'inspector_id',	'po_qty',
        'actual_carton_qty',	'actual_measurement_qty',	'is_complete',
        'got_workmanship',	'got_measurement',	'got_label_print_mark',

        'aql_critical_id',	'aql_major_id',	'aql_minor_id',	'aql_inspect_level_id',
        'suggest_workmanship_pcs',	'suggest_measurement_pcs',	'suggestion_carton',

        'major_defect_accept',	'minor_defect_accept',	'critical_defect_accept',
        'actual_major_defect',	'actual_minor_defect',	'actual_critical_defect',
        'workmanship_is_pass',
        'sampling_plan',

        'company_id',
        'contact_to',
        'contact_email',
        'contact_phone',
        'contact_person',
        'factory_id',
        'report_date',
        'jobs_id'

    ];
    public function factory(){
        return $this->belongsTo(Setup\Inspection\Factory::class, 'factory_id');

    }
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    public function docType()
    {
        return $this->belongsTo(InspectionDocType::class, 'doc_type');
    }


    public function critical()
    {
        return $this->belongsTo(Level::class, 'aql_critical_id');
    }
    public function major()
    {
        return $this->belongsTo(Level::class, 'aql_major_id');
    }
    public function minor()
    {
        return $this->belongsTo(Level::class, 'aql_minor_id');
    }
    public function inspectionLevel()
    {
        return $this->belongsTo(InspectionLevel::class, 'aql_inspect_level_id');
    }
    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class, 'inspection_id');
    }
    public function styleInformation()
    {
        return $this->hasMany(StyleInformation::class, 'header_id');
    }
    public function materialAttachment()
    {
        return $this->hasMany(MaterialAttachment::class, 'header_id');
    }
    public function resultSummary()
    {
        return $this->hasMany(ResultSummary::class, 'header_id');
    }
    public function remark()
    {
        return $this->hasMany(Remark::class, 'header_id');
    }
    public function quantity()
    {
        return $this->hasManyDeepFromRelations(
            $this->styleInformation(),
            (new styleInformation())->quantity()
        );
    }

    public function workmanship(): HasMany
    {
        return $this->hasMany(WorkmanshipCheck::class,'header_id');
    }
    function onSiteTest(): HasMany
    {
        return $this->hasMany(OnSiteTest::class,'header_id');
    }
    function measurementSummary(){
        return $this->hasMany(Measurement\Header::class, 'inspection_id');
    }
    function barcodeCtn(): hasOne
    {
        return $this->hasOne(ShippingCtn::class, 'header_id', 'id');
    }
    function packingBarcodeHeader(): hasOne
    {
        return $this->hasOne(PackingBarcodeHeader::class, 'header_id');
    }
    function packingAssortments(): hasOne
    {
        return $this->hasOne(Inspection\Packing\Assortment\Header::class, 'header_id');
    }
    function packCtnChkPt(): hasOne{
        return $this->hasOne(Inspection\PackCtnChkPt\Header::class, 'header_id');
    }
    function labelPrintMark(): hasMany
    {
        return $this->hasMany(Labelprintmark::class, 'header_id');
    }
    function shippingMarkResult(): HasOne
    {
        return $this->HasOne(ShippingMarkResult::class, 'header_id');
    }
    function gcc(): HasMany
    {
        return $this->hasMany(GCC::class, 'header_id');
    }
    function gccResult(): HasOne{
        return $this->hasOne(GCCResult::class, 'header_id');
    }
    function samplePullProcessType(): HasMany
    {
        return $this->hasMany(SampleTypeRecorded::class,'header_id');
    }
    public function samplePullType(): HasMany
    {
        return $this->hasMany(SamplePull::class,'header_id');
    }
    public function washEval(){
        return $this->hasOne(Inspection\WashEval\Header::class, 'header_id');
    }
    public function ctnNPriceTag()
    {
        return $this->hasMany(CtnNPriceTagHeader::class, 'header_id');
    }

    public function onSiteHomeLaundry(){
        return $this->hasMany( Inspection\OnSiteHomeLaundry::class,'header_id');
    }
    public function printEval()
    {
        return $this->hasMany( Inspection\PrintEval::class, 'header_id');
    }
    public function printEvalSummary()
    {
        return $this->hasOne( Inspection\PrintEval\Summary::class, 'header_id');
    }

    public function photograph(){

        return $this->hasMany(Inspection\PhotoGraph\Header::class, 'header_id');
    }

    public function companyContact(): BelongsTo
    {
        return $this->belongsTo(Setup\Inspection\Company::class, 'company_id');
    }
    public function cloud(): hasOne
    {
        return $this->hasOne(Inspection\Cloud::class, 'inspection_header_id');
    }
    public function pdfStatus()
    {
        return $this->hasOne(PdfStatus::class, 'jobs_id', 'jobs_id');
    }
    public function manualMeasurementOOTRecord(): HasMany
    {
        return $this->hasMany(Inspection\ManualMeasurementOOTRecord::class, 'header_id');
    }

    public function otherTestWithoutPhoto()
    {
        return $this->hasMany(Inspection\OtherTestWithoutPhoto::class, 'header_id');
    }

    public function involvedInspector()
    {
        return $this->hasManyThrough(
            User::class,
            Inspection\Inspector::class,
            'header_id',
            'id',
            'id',
            'inspector_id'
        );
    }


    public function purchaseOrderList()
    {
        return $this->hasManyDeepFromRelations(
            $this->purchaseOrder(),
            (new purchaseOrder())->number()
        );
    }
    public  function garmentReference(){
        return $this->hasOne(GarmentReference::class,'header_id');
    }
    public function getDocStatusAttribute()
    {
        if($this->is_complete) {
            return 'complete';
        } else {
            return 'progress';
        }
    }
    public function getCreatedFormatAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
    public function openedCarton()
    {
        return $this->hasMany(Carton::class, 'inspection_id');
    }
    public function scannedDocument(): HasMany
    {
        return $this->hasMany(ScannedDocument::class, 'header_id');
    }

    /* ------------------------------- Take Photo ------------------------------- */
    public function photoDefect()
    {
        return $this->hasMany(TakePhotoDefects::class, 'inspection_id');
    }
    public function photoView()
    {
        return $this->hasMany(TakePhotoView::class, 'inspection_id');
    }
    public function photoTest()
    {
        return $this->hasMany(TakePhotoTest::class, 'inspection_id');
    }
    public function photoEvaluate()
    {
        return $this->hasMany(TakePhotoEvaluate::class, 'inspection_id');
    }
    public function measureCritical(){
        return $this->hasOne(Inspection\Measurement\Critical::class,'header_id');
    }


    /* ------------------------------- Take Photo ------------------------------- */

    public function measurement()
    {
        return $this->hasMany(MeasurementHeader::class, 'inspection_id');
    }
    public function scopeOnlyBuyer($q, $buyers)
    {
        return $q->where(['buyer_id'=>$buyers]);
    }
    public function scopeProfile($q, $v){
        return $q->where(['id'=>$v]);
    }

    function manualMeasurement(){
        return $this->hasMany(ManualMeasurementHeader::class, 'header_id');
    }

    public function buyerAEORelation()
    {
        return [
            'buyer',
            'companyContact',
            'docType',
            'styleInformation.style',
            'styleInformation.purchaseOrder',
            'materialAttachment.name',
            'inspector',
            'involvedInspector',
            'resultSummary.title',
            'remark',
            'quantity',
            'ctnNPriceTag.color',
            'ctnNPriceTag.detail.size',
            'washEval.handFeel.color',
            'washEval.shadeConsistency.color',
            'washEval.jeans.contextOfJeans',
            'openedCarton.purchaseOrder',
            'printEval.appearances',
            'printEvalSummary',
            'garmentReference',
            'critical','major','minor','inspectionLevel',
            'photoDefect.color',
            'photoDefect.defect.translation',
            'workmanship.checkPoint',
            'onSiteTest.title',
            'onSiteHomeLaundry.title',
            'measurementSummary.item.chart.checkpoint',
            'manualMeasurement.measurementsWithValues',
            'manualMeasurementOOTRecord.measurementPoint',
            'manualMeasurementOOTRecord.color',
            'manualMeasurementOOTAllow',
            'measureCritical',
            'labelPrintMark.locations.title',
            'photograph',
            'photograph.detail.title',
            'photograph.purchaseOrder',
            'otherTestWithoutPhoto.title'
        ];
    }
    function manualMeasurementOOTAllow(){
        return $this->hasOne(ManualMeasurementOotAllow::class, 'header_id');
    }

    public function buyerJoeFreshRelation()
    {
        return [
            'factory',
            'buyer',
            'docType',
            'companyContact',
            'styleInformation.style',
            'styleInformation.purchaseOrder',
            'involvedInspector',
            'materialAttachment.name',
            'inspector', 'resultSummary.title',
            'remark','quantity','openedCarton.purchaseOrder',
            'critical','major','minor','inspectionLevel','photoDefect.color', 'photoDefect.defect.translation',
            'workmanship.checkPoint','onSiteTest.title', 'measurementSummary.item.chart',
            'manualMeasurement.measurementsWithValues','barcodeCtn',
            'packingBarcodeHeader.detail.color', 'packingBarcodeHeader.detail.size',
            'packingAssortments.detail.purchaseOrder.number', 'packCtnChkPt.detail.checkpoint',
            'labelPrintMark.locations.title', 'shippingMarkResult', 'gcc', 'gccResult',
            'samplePullProcessType.sampleType',
            'samplePullType.sampleType', 'samplePullType.style','scannedDocument.title','photograph.detail.title',
            'photograph.purchaseOrder'
        ];
    }

    public function buyerDisneyRelation()
    {
        return [
            'buyer', 'companyContact', 'docType', 'styleInformation.style', 'involvedInspector',
            'styleInformation.purchaseOrder', 'materialAttachment.name', 'inspector',
            'resultSummary.title', 'remark', 'quantity', 'openedCarton.purchaseOrder',
            'garmentReference.related', 'critical', 'major', 'minor', 'inspectionLevel',
            'photoDefect.color', 'photoDefect.defect.translation', 'workmanship.checkPoint',
            'onSiteTest.title', 'measurementSummary.item.chart', 'measurementSummary.profile.charts.detail',
            'measurementSummary.profile.size',
            'measurementSummary.profile.style', 'measurementSummary.profile.productName',
            'measurementSummary.profile.productCategory',
            'measurementSummary.profile.productDesc', 'measurementSummary.item.size',
            'measurementSummary.item.color', 'labelPrintMark.locations.title', 'photograph',
            'photograph.detail.title', 'photograph.purchaseOrder'
        ];
    }
    public function scopeGetBuyerJeoFresh($query,$headerId){
        return $query->with(self::buyerJoeFreshRelation())->where(['id'=>$headerId]);
    }
    public function scopeGetBuyerAEO($query,$headerId){
        return $query->with(self::buyerAEORelation())->where(['id'=>$headerId]);
    }
    public function scopeGetBuyerDisney($query,$headerId){
        return $query->with(self::buyerDisneyRelation())->where(['id'=>$headerId]);
    }
}
