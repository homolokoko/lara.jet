<?php

namespace App\Models\Inspector\Endline;

use App\Models\GarmentTracking\Module\Endline;
use App\Models\GarmentTracking\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Size;
use App\Models\Configure\Color;
use App\Models\Configure\Styles;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Item extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = "insp_endline_item";
    protected $fillable = [
        'insp_endline_profile_id', 'item_no', 'sizes_id', 'color_id', 'is_pass', 'is_repair', 'is_reject',
        'is_acceptable',
        'rework_qty'
    ];
    protected $appends = [
        'rightFirstTime',
        'reworkPass',
    ];
    protected $sequences = ['item_no'];
    public $timestamps = false;

    public function measure()
    {
        return $this->hasMany(Measure::class, 'insp_measure_endline_item_id');
    }
    public function defect()
    {
        return $this->hasMany(Defect::class, 'insp_measure_endline_item_id');
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
        return $this->belongsTo(Profile::class, 'insp_endline_profile_id');
    }
    public function Comment()
    {
        return $this->hasMany(Comment::class, 'insp_measure_endline_item_id');
    }
    public function workstation()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new profile)->locate()
        );
    }
    public function repair()
    {
        return $this->hasMany(Repair::class, 'insp_endline_item_id');
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new profile)->style()
        );
    }
    public function version()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->profile(),
                (new profile)->version()
            );
    }
    public function purchaseOrder()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new profile)->purchaseOrder()
        );
    }

    public function buyer()
    {
        return $this->hasOneDeepFromRelations(
            $this->style(),
            (new Styles)->buyer()
        );
    }

    public function inspector()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new profile)->inspector()
        );
    }

    public function rework()
    {
        return $this->hasMany(GarmentReworkRecord::class, 'item_id');
    }

    public function garmentCode(): BelongsTo
    {
        return $this->belongsTo(Endline::class, 'id', 'insp_endline_item_id');
    }

    public function latestGarmentCodeTransaction(): HasOneThrough
    {
        return $this->hasOneThrough(
            Transaction::class,    // The model we ultimately want to access (Transaction)
            Endline::class, // The model that acts as a bridge (Endline)
            'insp_endline_item_id',  // Foreign key on `Endline` linking to `this` model
            'garment_tracking_id',  // Foreign key on `Transaction` linking to `Endline`
            'id',  // Primary key in `this` model
            'garment_tracking_id' // Primary key in `Endline`
        )->latest();
    }

    public function garmentCodeTransaction()
    {
        return $this->hasManyThrough(
            Transaction::class,    // The model we ultimately want to access (Transaction)
            Endline::class, // The model that acts as a bridge (Endline)
            'insp_endline_item_id',  // Foreign key on `Endline` linking to `this` model
            'garment_tracking_id',  // Foreign key on `Transaction` linking to `Endline`
            'id',  // Primary key in `this` model
            'garment_tracking_id' // Primary key in `Endline`
        )->transactionAccept();
    }

    public function getRightFirstTimeAttribute(): bool
    {
        return ($this->is_pass && ! $this->is_repair);
    }

    public function getReworkPassAttribute(): bool
    {
        return ($this->is_repair && $this->is_acceptable);
    }

    public function scopeReworkPass($query)
    {
        return $query->where(['is_repair' => true, 'is_acceptable' => true]);
    }

    public function scopeFirstTimeCheck($query)
    {
        return $query->where(['is_repair' => false, 'is_acceptable' => false])->orWhere(
            ['is_pass' => true, 'is_acceptable' => false]
        );
    }

    public function scopeAccepted($query)
    {
        return $query->where(['is_repair' => false, 'is_acceptable' => true]);
    }

    public function scopeWrongFirstTime($query)
    {
        return $query->where(['is_pass' => false, 'is_repair' => true]);
    }

    public function scopeRightFirsTime($query)
    {
        return $query->where(['is_pass' => true, 'is_repair' => false]);
    }

    public function scopeDefected($query)
    {
        return $query->where(['is_repair' => false]);
    }
}
