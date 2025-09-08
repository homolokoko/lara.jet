<?php

namespace App\Models\Configure\PSC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'psc_section_translation';
    protected $fillable = ['locale', 'translated'];
}
