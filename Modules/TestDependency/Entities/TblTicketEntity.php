<?php

namespace Modules\TestDependency\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblTicketEntity extends Model
{
    use HasFactory;

    protected $table = 'tblticket_info';
    protected $fillable = [
        'tblID',
        'tktd_id',
        'ticketID',
        'qty',
        'orderno',
        'spID',
        'buyerpo',
        'garmentID',
        'styleno',
        'colorID',
        'colorname',
        'size_name',
        'wpdID',
        'statusID'
    ];

    protected static function newFactory()
    {
        return \Modules\TestDependency\Database\factories\TblTicketEntityFactory::new();
    }
}
