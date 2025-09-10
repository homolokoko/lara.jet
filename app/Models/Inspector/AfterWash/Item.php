<?php

namespace App\Models\Inspector\AfterWash;

use App\Http\Controllers\Library\GarmentTracking;
use App\Models\Configure\Color;
use App\Models\Configure\Size;

use App\Models\GarmentTracking\Module\Endline;
use App\Models\GarmentTracking\Transaction;
use App\Models\GarmentTracking\Module\Afterwash as GarmentTrackingAfterwash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Item extends Model
{
    use HasFactory;
    use HasRelationships;

    public $table = "insp_afterwash_item";
    protected $fillable = [
        'insp_profile_id',
        'item_no', 'sizes_id', 'color_id', 'is_pass', 'is_repair', 'is_reject',
        'is_acceptable'

    ];
    protected $sequences = ['item_no'];
    public $timestamps = false;
    protected $appends = [
        'rightFirstTime',
        'reworkPass',
    ];


    public function itemDefect()
    {
        return $this->hasMany(ItemDefect::class, 'insp_item_id');
    }

    public function repair()
    {
        return $this
            ->hasMany(Repair::class, 'insp_item_id');
    }

    public function sizes()
    {
        return $this->belongsTo(Size::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'insp_profile_id');
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile())->style()
        );
    }
    public function version(){
        return $this
            ->hasOneDeepFromRelations(
                $this->profile(),
                (new Profile)->version()
            );
    }
    public function purchaseOrder()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile())->purchaseOrder()->withTrashed()
        );
    }
    public function inspector()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile())->inspector()
        );

    }
    public function latestGarmentCodeTransaction(){
        return $this->hasOneThrough(
            Transaction::class,    // The model we ultimately want to access (Transaction)
            GarmentTrackingAfterwash::class, // The model that acts as a bridge (Endline)
            'insp_afterwash_item_id',  // Foreign key on `Endline` linking to `this` model
            'garment_tracking_id',  // Foreign key on `Transaction` linking to `Endline`
            'id',  // Primary key in `this` model
            'garment_tracking_id' // Primary key in `Endline`
        )->latest();
    }

    public function transactionAccept()
    {
        return $this->hasManyThrough(
            Transaction::class,    // The model we ultimately want to access (Transaction)
            GarmentTrackingAfterwash::class, // The model that acts as a bridge (AfterWash)
            'insp_afterwash_item_id',  // Foreign key on `Endline` linking to `this` model
            'garment_tracking_id',  // Foreign key on `Transaction` linking to `Endline`
            'id',  // Primary key in `this` model
            'garment_tracking_id' // Primary key in `Endline`
        )->transactionAccept()->module('afterwash');
    }
    public function getReworkPassAttribute(): bool
    {
        return ($this->is_repair && $this->is_acceptable);
    }

    public function scopeReworkPass($query)
    {
        return $query->where(['is_repair' => true, 'is_acceptable' => true]);
    }

    public function getRightFirstTimeAttribute(): bool
    {
        return ($this->is_pass && ! $this->is_repair);
    }
    public function garmentCode(): BelongsTo
    {
        return $this->belongsTo(GarmentTrackingAfterwash::class, 'id', 'insp_afterwash_item_id');
    }

}
