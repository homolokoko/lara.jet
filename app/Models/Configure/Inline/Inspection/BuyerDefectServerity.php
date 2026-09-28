<?php

namespace App\Models\Configure\Inline\Inspection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerDefectServerity extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'inline_inspection_buyer_defect_serverity';
    protected $fillable = ['value','inline_inspection_buyer_defect_id'];
    protected $appends = ['status'];

    function getStatusAttribute()
    {
        switch($this->value){
            case 1:
                return 'critical';
                break;
            case -1:
                return 'major';
                break;
            case 0:
                return 'minor';
                break;
        }
    }
}
