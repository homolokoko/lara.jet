<?php

namespace App\Models\Configure;

use App\Models\Configure\Cutting\Panel;
use App\Models\Configure\Cutting\Rate as CuttingRate;
use App\Models\Configure\Fabric\StyleFabricContent;
use App\Models\Inspector\Cutting\PanelImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Relation\StylePurchaseOrder;
use App\Models\Configure\Style\CutPanel;
use App\Models\Configure\Style\Profile;
use App\Models\Configure\Style\Color as ProfileColor;
use App\Models\Configure\Cutting\StylePanel as CuttingStylePanel;
use App\Models\Inspector\Cutting\Header as CuttingHeader;
use App\Models\Configure\StylesApperalsCheckPoint;
use App\Models\Inspector\CartonAudit\Form\Header as InspectorCartonAuditHeader;
use App\Models\Inspector\Accessory\Header as AccessoryHeader;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Vinkla\Hashids\Facades\Hashids;
use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;
use Bkwld\Cloner\Cloneable;

use App\Models\Configure\Measure\Profile\Header as MeasureProfile;

class Styles extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Cloneable;
    use HasRelationships;

    protected $fillable = ['name', 'buyers_id', 'type'];
    protected $cloneable_relations = ['styleApperal', 'purchaseOrder', 'jobseqs', 'buyer', 'type'];

    function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyers_id');
    }
    function styleApperal()
    {
        return $this->hasMany(StylesApperals::class);
    }
    function measureProfile()
    {
        return $this->hasMany(MeasureProfile::class, 'styles_id');
    }


    function measureCheckPoint()
    {
        return $this->hasManyDeepFromRelations(
            $this->measureProfile(),
            (new MeasureProfile())->detail()
        );
    }


    function purchaseOrder()
    {
        return $this->belongsToMany(PurchaseOrders::class, 'styles_purchase_orders');
    }
    function jobseqs()
    {
        return $this->hasMany(JobSeqs::class, 'styles_id');
    }
    function cartonAudit()
    {
        return $this->hasMany(InspectorCartonAuditHeader::class, 'style_id');
    }

    function replicateRow()
    {
        $clone = $this->replicate();
        $clone->name = $clone->name . "_copy_" . Str::random(3);
        $clone->push();
        $this->replicateStyleApparel($clone);
        $this->replicateJobSeqs($clone);
        return $clone->id;
    }
    function generateFileName($style)
    {
        $client = new Client();
        $fileName = $client->generateId($size = 21, $mode = Client::MODE_DYNAMIC);
        $image =  Hashids::connection('styles')->encode($style) . "/" . $fileName . ".svg";
        $editable =  Hashids::connection('styles')->encode($style) . "/" . $fileName . ".json";
        return [$image, $editable];
    }
    function copyFile($disk, $newFileName, $content)
    {
        Storage::disk('styleApperal')->put($newFileName, $content);
    }
    function replicateStyleApparel($clone)
    {
        foreach ($this->styleApperal as $styleApperal) {

            list($image, $editable) = $this->generateFileName($styleApperal->styles_id);
            $disk = "styleApperal";

            $this->copyFile($disk, $image, $styleApperal->image);
            $this->copyFile($disk, $editable, $styleApperal->editable);
            $name = $styleApperal->name . "_copy_" . Str::random(3);
            $styleApperal = $styleApperal->toArray();
            //$styleApperal->image =$image;
            //$styleApperal->editable =$editable;
            //$styleApperal->name = $styleApperal->name."_copy_".Str::random(3);
            Arr::set($styleApperal, 'name', $name);
            Arr::set($styleApperal, 'image', $image);
            Arr::set($styleApperal, 'editable', $editable);
            $styleApperalId = $clone->styleApperal()->create($styleApperal)->id;
            foreach (Arr::get($styleApperal, 'checkpoint') as $key => $checkpoint) {
                Arr::set($checkpoint, 'styles_apperals_id', $styleApperalId);
                StylesApperalsCheckPoint::create($checkpoint);
            }
        }
    }
    function replicateJobSeqs($clone)
    {
        foreach ($this->jobseqs as $jobseqs) {
            $jobseqs->translate('en')->name = $jobseqs->translate('en')->name;
            if ($jobseqs->hasTranslation('cn')) {
                $jobseqs->translate('cn')->name = $jobseqs->translate('cn')->name;
            }
            if ($jobseqs->hasTranslation('kh')) {
                $jobseqs->translate('kh')->name = $jobseqs->translate('kh')->name;
            }
            $jobseqs->style_profile_id = 0;
            $clone->jobseqs()->create($jobseqs->toArray());
        }
    }
    function profile()
    {
        return $this->hasMany(Profile::class, 'style_id');
    }

    function profileColor()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->colorsName()
        );
    }
    function profileSize()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->sizeName()
        );
    }
    function  profileVersion()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->version()
        );
    }
    function profileApparelName()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->apparelName()
        );
    }

    function profileApparelCheckPoint()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->checkpointArea()
        );
    }
    function profileAppparel()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->apparel()
        );
    }


    function operation()
    {
        return $this->hasManyDeepFromRelations(
            $this->profile(),
            (new profile)->jobSeq()
        );
    }

    function operationList()
    {
        return $this->hasMany(JobSeqs::class, 'styles_id');
    }


    public function stylePurchaseOrder()
    {
        return $this->hasManyThrough(
            PurchaseOrders::class,
            StylePurchaseOrder::class,
            'styles_id',
            'id',
            'id',
            'purchase_orders_id',
        );
    }

    function cuttingPanel()
    {
        return $this->hasMany(CuttingStylePanel::class, 'styles_id');
    }
    function cuttingPanelName()
    {
        return $this->hasManyThrough(
            Panel::class,
            CuttingStylePanel::class,
            'styles_id',
            'id',
            'id',
            'panel_id',

        );
    }

    function cuttingRate()
    {
        return $this->hasOne(CuttingRate::class, 'styles_id');
    }
    function cuttingHeader()
    {
        return $this->hasMany(CuttingHeader::class, 'style_id');
    }
    function accessoryHeader()
    {
        return $this->hasMany(AccessoryHeader::class, 'styles_id');
    }
    function fabric()
    {
        return $this->hasOne(StyleFabricContent::class, 'style_id', 'id');
    }
    function washType()
    {
        return $this->hasOne('App\Models\Configure\Style\WashType', 'styles_id', 'id');
    }
    function washTypeTitle()
    {
        return $this->hasOneDeepFromRelations(
            $this->washType(),
            (new \App\Models\Configure\Style\WashType)->washType()
        );
    }

    function scopeGetStyle($q, $id)
    {
        return $q->where(['id' => $id]);
    }

    function scopeGetProfile($query, $value)
    {
        return $query->whereHas('profile', function ($query) use ($value) {
            return $query->where('id', $value);
        });
    }

    public function symmetriesVersions()
    {
        return $this->hasManyThrough(
            Version::class,
            SymmetryCheckpoint::class,
            'style_id',
            'id',
            'id',
            'version_id',
        );
    }
    public function scopeGetStyleByName($query, $name)
    {
        return $query->where('name', '=', $name);
    }

    public function colorsList(): HasManyThrough
    {
        return $this->hasManyThrough(
            Color::class,       // The final model you want to access (e.g., Color)
            StyleColor::class,  // The intermediate model (e.g., StyleColor)
            'style_id',         // Foreign key on the StyleColor table that refers to the Style model
            'id',               // Foreign key on the Color table (or local key in Color to connect StyleColor)
            'id',               // Local key on the Style model
            'color_id'          // Local key on the StyleColor model that refers to Color
        );
    }

    public function sizesList(): HasManyThrough
    {
        return $this->hasManyThrough(
            Size::class,       // The final model you want to access (e.g., Color)
            StyleSize::class,  // The intermediate model (e.g., StyleColor)
            'style_id',         // Foreign key on the StyleColor table that refers to the Style model
            'id',               // Foreign key on the Color table (or local key in Color to connect StyleColor)
            'id',               // Local key on the Style model
            'size_id'          // Local key on the StyleColor model that refers to Color
        );
    }

    public function getNameAttribute($value)
    {
        if ($this->type == 'style') {
            $data = explode('_', $value);
            return $data[0];
        }
        return $value;
    }
    public function scopeSearchBuyer($query, $buyerId){
        return $query->where('buyers_id', '=', $buyerId);
    }
}
