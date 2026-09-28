<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Models\Inspector\Endline\Repair as EndlineRepair;
use App\Models\Report\IdentityCard\LocateMonitor;
use QrCode;

class IdentityCard extends Model
{
    use HasFactory;
    public $table = 'identity_card';
    protected $fillable = ['uuid', 'image', 'is_active', 'is_occupied', 'is_printed'];

    function InlineGarmentRepair()
    {
        return $this->hasMany(EndlineRepair::class, 'identity_card_id');
    }
    function getImageAttribute($value)
    {
        if (!$value) {
            return $value;
        } else if (Storage::disk('qrcode')->exists($value)) {
            $image = Storage::disk('qrcode')->url($value);
        } else {
            $image = QrCode::size(150)->format('png')->generate($this->uuid);
            Storage::disk('qrcode')->put($value, $image);
            $image = Storage::disk('qrcode')->url($image);
        };
        return  $image;
        //$url = url('view', ['disk' => 'qrcode', 'file' => $value]);
        //dd(Storage::disk('local')->)
        //return '/storage-' . tenant('id') . '/' . Storage::disk('qrcode')->url($value);
        //return ($value) ? Storage::disk('qrcode')->url('tenant' . tenant('id') . "/app/public/qrcode", $value) : '';
    }
    function monitorLocate()
    {
        return $this->belongsTo(LocateMonitor::class, 'id', 'identity_card_id');
    }
}
