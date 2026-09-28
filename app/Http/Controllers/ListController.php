<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auditor\Template;
use App\Models\Auditor\Setup\Inspection\OnSiteTest;
use App\Models\Auditor\Setup\Inspection\Factory;
use App\Models\Configure\Measure\Profile\Header as Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Configure;
use App\Models\Auditor;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\User;
use Throwable;

class ListController extends Controller
{
    //
    public $selectModel;
    public $model =
        [
            'style' => Configure\Styles::class,
            'size' => Configure\Size::class,
            'color' => Configure\Color::class,
            'version' => Configure\Version::class,
            'unit' => Configure\Unit::class,
            'productCategory' => Configure\Product\Category::class,
            'productName' => Configure\Product\Name::class,
            'workstation' => Configure\Workstations::class,
            'workstation_locate' => Configure\WorkstationLocate::class,
            'defect' => Configure\Defects::class,
            'buyer' => Configure\Buyers::class,
            'productDevelopReportType' => Configure\ProductDevelop\ReportType::class,
            'purchaseOrder' => Configure\PurchaseOrders::class,
            'docType' => Auditor\Inspection\DocType::class,
            'customer' => Customer::class,
            'users' => User::class,
            'cause' => Configure\Defect\Cause::class,
            'contextOfJeans'=> Configure\ContextOfJeans::class,
            'onSiteTestTitle'=>OnSiteTest::class,
            'factory'=>Factory::class,
            'measurementVersion'=> Profile::class,
        ];
    public $locate = [
        'type' => ['sew' => 1],
        'shift' => ['day' => true, 'night' => false]
    ];


    public function validateModel($selected)
    {

        (Arr::has($this->model, $selected)) ? $this->getModel($selected) : false;
    }
    public function getModel($model)
    {
        $this->selectModel = Arr::get($this->model, $model, null);
    }
    public function getList($model)
    {
        try {
            $this->validateModel($model);
            throw_if(!$this->selectModel, 'invalid model');

            return $this->selectModel::get();
        } catch (Throwable $th) {
            dd($th);
        }
    }
    public function getValueProperty($data)
    {
        if (isset($data->id)) {
            return $data->id;
        } elseif (isset($data->value)) {
            return $data->value;
        } elseif (is_array($data) &&  Arr::has($data, 'id')) {
            return Arr::get($data, 'id', 'unknown');
        }
    }
    public function getTextProperty($data)
    {
        if (isset($data->name)) {
            return $data->name;
        } elseif (isset($data->text)) {
            return $data->text;
        } elseif (isset($data->no)) {
            return $data->no;
        } elseif (is_array($data) &&  Arr::has($data, 'name')) {
            return Arr::get($data, 'name', 'unknown');
        }
    }
    public function generate($data)
    {
        return  $data->map(function ($item) {
            $itemName = $this->getTextProperty($item);
            $itemId = $this->getValueProperty($item);
            return $this->option($itemId, $itemName);
        })->toArray();
    }
    public function option($value, $name)
    {
        return ['value' => $value, 'text' => $name];
    }
    public function getLocate($type = 'SEW', $dayShift = 'day')
    {
        $locateType = Arr::get($this->locate, 'type');
        $locateShift = Arr::get($this->locate, 'shift');
        $type =  Arr::get($locateType, Str::of($type)->trim()->lower()->__toString(), null);


        $dayShift =  Arr::get($locateShift, Str::of($dayShift)->trim()->lower()->__toString(), null);
        $this->getModel('workstation_locate');
        $list = $this->selectModel::where('workstation_locates_type_id', '=', $type)->where('is_day_shift', '=', $dayShift)->get();
        return $list->map(function ($item) {
            $name = Str::of($item->name)->replace('SEW', ' ')->trim()->__toString();
            return ['value' => $item->id, 'text' => $name];
        });
    }

    public function getWorkStation($locateId)
    {
        $this->getModel('workstation');

        $query = $this->selectModel::with(['workstationCategory', 'workstationLocate'])
            ->join('workstation_locates', 'workstations.workstation_locate_id', '=', 'workstation_locates.id');

        if (Arr::accessible($locateId)) {
            $query->whereIn('workstation_locates.id', $locateId);
        } else {
            $query->where('workstation_locates.id', $locateId);
        }

        return $query->get(['workstations.*']) // specify columns to avoid ambiguity
        ->map(function ($item) {
            return ['value' => $item->id, 'text' => $item->name];
        })
            ->sortBy('text')
            ->values();
    }
    public function getBuyer()
    {
        $this->getModel('buyer');
        return $this->selectModel::get()->map(function ($item) {
            return  ['value' => $item->id, 'text' => $item->name];
        })->sortBy('text')->values();
    }
    public function getStyle($buyerId = null)
    {

        $this->getModel('style');

        if ($buyerId) {
            $data = $this->selectModel::where(['buyers_id' => $buyerId])->get();
        } else {
            $data = $this->selectModel::get();
        }
        return $data = $data->map(function ($item) {
            return  ['value' => $item->id, 'text' => Str::of( $item->name)->trim()];
        })->sortBy('text')->values();
    }
    public function getPurchaseOrder($styleId)
    {
        $this->getModel('purchaseOrder');
        return $this->selectModel::whereHas('style',function ($relation) use ($styleId){
            return $relation->where('styles_id', '=', $styleId);
        })->get()->map(function ($item) {
            return  ['value' => $item->id, 'text' =>Str::of( $item->no)->trim()];
        })->sortBy('text')->values();
    }
    public function getAuditorDocType()
    {
        $this->getModel('docType');

        return $this->selectModel::get()->map(function ($item) {
            return  ['value' => $item->id, 'text' => $item->name];
        })->sortBy('text')->values();
    }
    public function getDefect()
    {
        $this->getModel('defect');

        return $this->selectModel::with('translation')->get()->map(function ($item) {
            if ($item->translation) {
                return  ['value' => $item->id, 'text' => $item->translation->name];
            } else {
                return;
            }
        })->reject(function ($i) {
            return !$i;
        })->sortBy('text')->values();
    }

    public function getCustomer()
    {
        $this->getModel('customer');
        return $this->selectModel::get()->map(function ($item) {
            return  ['value' => $item->id, 'text' => $item->name];
        })->sortBy('text')->values();
    }
    public function getAllStyle()
    {
        $this->getModel('style');
        return $this->selectModel::get()->map(function ($item) {
            return  ['value' => $item->id, 'text' => $item->name];
        })->sortBy('text')->values();
    }

    public function getStaff()
    {
        $this->getModel('users');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->email . ' ' . $i->name];
        })->values();
    }
    public function getCause()
    {
        $this->getModel('cause');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->name];
        })->values();
    }

    public function TranslationList($data)
    {
        return  $data->map(function ($item) {
            $itemId = $item->id;
            $strRep = str_replace('_', ' ', $item->translated);
            $toCap = ucwords($strRep);
            $itemName = $toCap;
            return $this->option($itemId, $itemName);
        })->toArray();
    }
    public function getColor(){
        $this->getModel('color');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->name];
        })->values();
    }
    public function getContextOfJeans(){
        $this->getModel('contextOfJeans');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->name];
        })->values();
    }
    public function getOnSiteTestTitle(){
        $this->getModel('onSiteTestTitle');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->name];
        });
    }
    public function getSize()
    {
        $this->getModel('size');
        return $this->selectModel::get()->map(function ($item) {
            return ['value' => $item->id, 'text' => $item->name];
        });
    }
    public function getVersion()
    {
        $this->getModel('version');
        return $this->selectModel::get()->map(function ($item) {
            return ['value' => $item->id, 'text' => $item->name];
        });
    }
    public function getFactory()
    {
        $this->getModel('factory');
        return $this->selectModel::get()->map(function ($i) {
            return ['value' => $i->id, 'text' => $i->name];
        })->values();
    }
    public function getMeasurementVersion($styleId){
        $this->getModel('measurementVersion');
        return $this->selectModel::with('version')->where('styles_id', '=', $styleId)->get()->map(function ($item) {

            return  ['value' => $item->version->id, 'text' => $item->version->name];
        })->sortBy('text')->values();
    }
    public function getAuditTypeList(){
        return (new Template())->getAuditTypeList();
    }

}
