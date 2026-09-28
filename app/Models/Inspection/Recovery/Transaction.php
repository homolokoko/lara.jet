<?php

namespace App\Models\Inspector\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory;
    public $table = "recovery_transaction";
    protected $fillable = [
        'type',
        'users_id',
        'header_id'
    ];
    protected $type = ['1' => 'receive', '2' => 'send', '3' => 'dispose', '4' => 'disposeApprove', '5'=>'disposeReject'];

    public function getTypeAttribute($value)
    {
        return Arr::get($this->type, $value);
    }
    public function ScopeSend($q)
    {
        return $q->where(['type' => 2]);
    }
    public function ScopeDispose($q)
    {
        return $q->where(['type' => 3]);
    }
    public function comment()
    {
        return $this->hasOne(TransactionWithComment::class, 'transaction_id');
    }
}
