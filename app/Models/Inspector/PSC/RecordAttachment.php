<?php

namespace App\Models\Inspector\PSC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RecordAttachment extends Model
{
    use HasFactory;
    protected $table = 'psc_record_attachments';
    protected $fillable = ['psc_record_list_id', 'image', 'inspector_id', 'description' ];

    public $timestamps = false;

    function getImageAttribute($value)
    {
        if (!$value) {
            return '/noimage.png';
        }
        $exists = Storage::disk('psc')->exists($value);
        if (!$exists) {
            return '/noimage.png';
        }
       
        return  Storage::disk('psc')->url($value);
    }
}
