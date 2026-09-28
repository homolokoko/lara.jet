<?php

namespace App\Http\Livewire\Setup\Buyer;

use App\Models\Configure\Buyers;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class Table extends DataTableComponent
{
//    public function render()
//    {
//        return view('livewire.setup.buyer.table');
//    }

    protected $model = Buyers::class;

    public function configure(): void

    {

        $this->setPrimaryKey('id');

    }

    public function columns(): array
    {
        // TODO: Implement columns() method.
        return [

            Column::make('ID', 'id')

                ->sortable(),

            Column::make('Name','name')

                ->sortable(),
            Column::make('Action','id')

                ->format(

                    fn($value, $row, Column $column) => view('livewire.setup.buyer.table',compact('value','row','column'))

                ),
        ];
    }

    public function show($id)
    {
        return $this->model::where('id',$id)->first()->toArray();
    }

    public function submit($id,$name)
    {
        return $buyer = $this->model::where('id',$id)->update(['name'=>$name]);
    }

}
