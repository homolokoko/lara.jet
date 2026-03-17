<?php

namespace App\Models\Inspector\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TransactionWithComment extends Model
{
    use HasFactory;

    public $table = "recovery_transaction_comment";
    protected $fillable = [
        'transaction_id',    'image',    'comment', 'action'
    ];
    public $appends = ['image_url'];
    public $timestamps = false;

    // Storage::disk($module)/


    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }

    // public function getImageAttribute($value)
    // {
    //     return ($value) ? Storage::disk('recovery')->url($value) : '/noimage.png';
    // }

}
