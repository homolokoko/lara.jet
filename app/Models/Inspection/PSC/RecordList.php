<?php

namespace App\Models\Inspector\PSC;

use App\Models\Configure\PSC\Listed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class RecordList extends Model
{
    use HasFactory;
    use HasRelationships;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'psc_record_list';
    protected $fillable = [
        'profile_id','psc_list_id', 'is_checked', 'applied_status' , 'inspector_id'
    ];
    public $timestamps = false;

    function checkpoint(): \Staudenmeir\EloquentHasManyDeep\HasOneDeep
    {
        return $this->hasOneDeepFromRelations(
            $this->profileList(),
            ( new Listed())->checkpoint()
        );
    }


    function profileList(){
        return $this->belongsTo( Listed::class, 'psc_list_id');
    }
    function attachment(){
        return $this->hasOne('App\Models\Inspector\PSC\RecordAttachment', 'psc_record_list_id');
    }


}
