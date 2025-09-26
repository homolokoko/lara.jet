<?php

namespace App\Http\Controllers;

use App\Models\Configure\Styles;
use Illuminate\Http\Request;

class TestController extends Controller
{

    //
    function query()
    {
//        return view('test');
        return Styles::paginate()
            ->through(function($sty){
                $id = $sty->id;
                $name = $sty->name;
                $buyer = $sty->buyer()->exists();
                $profile = $sty->profile()->exists();
                $size = $sty->profileSize()->exists();
                $color = $sty->profileColor()->exists();
                $operation_code = $sty->jobseqs()->exists();
                $purchase_order = $sty->purchaseOrder()->exists();
                $sketch = $sty->profileApparelName()->exists();
                $panel = $sty->cuttingPanel()->exists();
                return compact('id','name','buyer','profile','size','color','panel','sketch','operation_code','purchase_order');
            })->toArray();

    }
}
