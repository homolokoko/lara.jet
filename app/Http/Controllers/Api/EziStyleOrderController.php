<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Library\Search\EziOrderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EziStyleOrderController extends Controller
{
    public function search(Request $request)
    {
        $order_info = new EziOrderInfo();
        $keyword = $request->get('keyword');
        $result = $order_info->search($keyword, 5);

        $final = [];
        for ($i = 0; $i < count($result); $i++) {
            $item = $result[$i];
            $explodeName = explode('_', $item->name);
            $number = $explodeName[0];
            $type = $item->type;
            $name = $item->name;
            $text = ($item->type == 'style' && count($explodeName) > 1) ? $item->name."(".$number.")" : $item->name;
            $final[] = compact('number', 'name', 'type', 'text');
        }
        return response()->json($final, 200);
    }
}
