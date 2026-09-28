<?php

namespace App\Models\Inspector\Cutting\Binaudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspector\Cutting\Header as CuttingHeader;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

#note  'total_correct_point', 'total_wrong_point', 'total_point' need to remove column.
class Header extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = "cutting_binAudit_header";
    protected $fillable = [
        'cutting_header_id', 'number','quantity',
        'total_correct_point', 'total_wrong_point', 'total_point'
    ];
    protected $casts =[
        'quantity' => 'integer',
    ];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(Detail::class, 'cutting_binAudit_header_id');
    }
    public function checkPoint(){
        return $this->hasManyDeepFromRelations(
            $this->details(), (new Detail())->checkpoint()
        );
    }

    public function cuttingHeader()
    {
        return $this->belongsTo(CuttingHeader::class, 'cutting_header_id');
    }
    public function scopeHeader($q,$v){
        return $q->where(['cutting_header_id'=>$v]);
    }
    public function scopeNumber($q,$v){
        return $q->where(['number'=>$v]);
    }
}
