<?php

namespace App\Http\Livewire\Management\User;

use App\Library\GetValueTextList;
use App\Models\User;
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
        return User::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->locale.' '.$item->name])->toArray();
    }

    public function getrecords($page,$perpage,$filter)
    {
        return User::with('parent','roles')->paginate($perpage,'*','page',$page)->toArray();
    }

    public function _createData($data)
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
        $root = User::find(1);

        $last_name = Arr::random($names);
        $first_name = Arr::random($names);
        $principle = User::create([
            'email'=>'ACE'. array_rand(range(10000,99999)),
            'name'=>"$last_name $first_name",
            'locale'=>"$last_name $first_name",
            'password' => Hash::make('123'),
        ]);
        $principle->syncRoles(4);
        if($root)
            $principle->makeChildOf($root);

        for($i=1;$i<3;$i++){
            $last_name = Arr::random($names);
            $first_name = Arr::random($names);
            $vice = User::create([
                'email'=>'ACE'. array_rand(range(10000,99999)),
                'name'=>"$last_name $first_name",
                'locale'=>"$last_name $first_name",
                'password' => Hash::make('123'),
            ]);
            $vice->syncRoles(5);
            $vice->makeChildOf($principle);
            for($j=1;$j<5;$j++){
                $last_name = Arr::random($names);
                $first_name = Arr::random($names);
                $senior = User::create([
                    'email'=>'ACE'. array_rand(range(10000,99999)),
                    'name'=>"$last_name $first_name",
                    'locale'=>"$last_name $first_name",
                    'password' => Hash::make('123'),
                ]);
                $senior->syncRoles(8);
                $senior->makeChildOf($vice);
                for($k=1;$k<10;$k++){
                    $last_name = Arr::random($names);
                    $first_name = Arr::random($names);
                    $member = User::create([
                        'email'=>'ACE'. array_rand(range(10000,99999)),
                        'name'=>"$last_name $first_name",
                        'locale'=>"$last_name $first_name",
                        'password' => Hash::make('123'),
                    ]);
                    $member->syncRoles(7);
                    $member->makeChildOf($senior);
                }
            }
        }


    }

    public function createData($data,$role)
    {
        try{
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|unique:users',
            ]);
            if($validator->fails()){
                return ['fail'=>true,'messages'=>$validator];
            }else{
                $root = User::find($data['responsible']);
                $child = User::create([
                    'password' => Hash::make('123'),
                    'name' => $data['name'],
                    'locale' => $data['locale'],
                    'email' => $data['email']
                ]);
                $child->syncRoles($role);
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
        return User::find($id)->toArray();
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
