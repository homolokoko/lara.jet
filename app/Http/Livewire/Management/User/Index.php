<?php

namespace App\Http\Livewire\Management\User;

use App\Library\GetValueTextList;
use App\Models\Member\Profile;
use Error;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.management.user.index');
    }

    public function getresponsible()
    {
        return Profile::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->locale.' '.$item->name])->toArray();
    }

    public function getrecords($page,$perpage,$filter)
    {
        return Profile::with('parent')->paginate($perpage,'*','page',$page)->toArray();
    }

    public function createData($data)
    {

        $names = [
            'James', 'Mary', 'John', 'Patricia', 'Robert', 'Jennifer', 'Michael', 'Linda', 'William', 'Elizabeth',
            'David', 'Barbara', 'Richard', 'Susan', 'Joseph', 'Jessica', 'Thomas', 'Sarah', 'Charles', 'Karen',
            'Christopher', 'Nancy', 'Daniel', 'Lisa', 'Matthew', 'Margaret', 'Anthony', 'Betty', 'Mark', 'Sandra',
            'Donald', 'Ashley', 'Steven', 'Kimberly', 'Paul', 'Emily', 'Andrew', 'Donna', 'Joshua', 'Michelle',
            'Kenneth', 'Carol', 'Kevin', 'Amanda', 'Brian', 'Melissa', 'George', 'Deborah', 'Edward', 'Stephanie',
            'Ronald', 'Rebecca', 'Timothy', 'Sharon', 'Jason', 'Laura', 'Jeffrey', 'Cynthia', 'Ryan', 'Kathleen',
            'Jacob', 'Amy', 'Gary', 'Angela', 'Nicholas', 'Shirley', 'Eric', 'Anna', 'Jonathan', 'Brenda',
            'Stephen', 'Pamela', 'Larry', 'Emma', 'Justin', 'Nicole', 'Scott', 'Helen', 'Brandon', 'Samantha',
            'Benjamin', 'Katherine', 'Samuel', 'Christine', 'Gregory', 'Debra', 'Alexander', 'Rachel', 'Patrick', 'Carolyn',
            'Frank', 'Janet', 'Raymond', 'Catherine', 'Jack', 'Maria', 'Dennis', 'Heather', 'Jerry', 'Diane',
        ];
        $responsible = 1695;

        for($i=1;$i<=100;$i++){
            $this->_createData([
                'responsible'=>$responsible,
                'email'=>'ACE'. array_rand(range(10000,99999)),
                'name'=>Arr::random($names).' '.Arr::random($names),
                'locale'=>Arr::random($names).' '.Arr::random($names),
            ]);
        }


    }

    public function _createData($data)
    {
        try{
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|unique:users',
            ]);
            if($validator->fails()){
                return ['fail'=>true,'messages'=>$validator];
            }else{
                $root = Profile::find($data['responsible']);
                $child = Profile::create([
                    'password' => Hash::make('123'),
                    'name' => $data['name'],
                    'locale' => $data['locale'],
                    'email' => $data['email']
                ]);
                if($root)
                    $child->makeChildOf($root);
                return ['fail'=>false,'messages'=>'Success'];
            }

        }catch(Error $err){
            return ['fail'=>true,'messages'=>$err->getMessage()];
        }
    }

    public function reviewData($id)
    {
        return Profile::find($id)->toArray();
    }

    public function updateData($data)
    {
        try{
            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required',
            ]);
            if($validator->fails()){
                return ['fail'=>true,'messages'=>$validator];
            }else{
                $root = Profile::find($data['responsible']);
                $child = Profile::where('id',$data['id']);
                $child->update([
                    'name' => $data['name'],
                    'locale' => $data['locale'],
                    'email' => $data['email']
                ]);
                if($root)
                    $child->first()->makeChildOf($root);
                return ['fail'=>false,'messages'=>'Success'];
            }

        }catch(Error $err){
            return ['fail'=>true,'messages'=>$err->getMessage()];
        }
    }

    public function deleteData($data)
    {
        try{
            Profile::where('id',$data['id'])->delete();
        }catch(Error $err){
            return ['fail'=>true,'messages'=>$err->getMessage()];
        }
    }
}
