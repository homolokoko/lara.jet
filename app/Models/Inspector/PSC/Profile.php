<?php

namespace App\Models\Inspector\PSC;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use App\Models\Configure\PSC\Section;
class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $table = 'psc_record_profile';
    protected $fillable = [
        'report_date', 'psc_section_id','is_finished',
        'version',
        'psc_list_id',
        'is_outdated'
    ];
    public function recordList(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RecordList::class, 'profile_id');
    }
    public function inspector(): \Staudenmeir\EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->involve(),
            (new Involve())->inspector()
        );
    }

    public function involve(){
        return $this->hasMany(Involve::class, 'profile_id');
    }
    public function section(){
        return $this->belongsTo( Section::class, 'psc_section_id');
    }

    /**
     * Retrieves records from the database for today's date and a specific section.
     *
     * @param object $query The query builder instance.
     * @param array $param An array of parameters. [version,psc_list_id, section ]
     * @return mixed The updated or created record.
     */
    public function scopeGetTodayWithSection(object $query, $sectionId)
    {
        $reportDate = Carbon::today()->format('Y-m-d');
        return $query->where( ['report_date' => $reportDate, 'psc_section_id' => $sectionId]);
    }
    public function scopeGetToday(){
        return $this->where('report_date',Carbon::today()->format('d-m-y'));
    }

    public function scopeGetDate($q, $date){
        //2024-01-08 to 2024-01-15
        $date =  explode(' ', $date);
        if(count($date) === 3){
            $from = Carbon::parse($date[0])->format('y-m-d');
            $to = Carbon::parse($date[2])->format('y-m-d');
            return $q->whereBetween('report_date',[$from, $to]);
        }else{
            return $q->where('report_date',Carbon::parse($date[0])->format('y-m-d'));
        }
    }

}
