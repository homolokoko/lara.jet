<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photograph extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_photograph';
    protected $fillable = ['user_id', 'file_path'];
    public $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::disk('staff')->url('photograph/'.$this->file_path);
    }

}
