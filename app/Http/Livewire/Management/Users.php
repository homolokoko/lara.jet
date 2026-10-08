<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.management.users');
    }

    public function getDataSource()
    {
        $responsible_people =  GetValueTextList::convert(User::get());
        $positions = GetValueTextList::convert(DB::table('roles')->get());
        return ['responsible_people'=>$responsible_people,'positions'=>$positions];
    }

    public function retrieveusers($page,$perpage,$filter)
    {
        $query = \App\Models\Staff\User::with('roles');
        return $query->paginate($perpage,'*','page',$page)->toArray();
    }

    public function submit($data)
    {
        $englishNames = [
            "Sokha", "Bopha", "Chantha", "Dara", "Sophea", "Vanna", "Sina", "Rith", "Narith", "Piseth",
            "Phally", "Sok", "Sao", "Chea", "Mony", "Rath", "Srey", "Nika", "Kosal", "Vireak",
            "Sothy", "Phalla", "Kalyan", "Kanha", "Malai", "Chanthou", "Sokhom", "Samnang", "Thyda", "Saro",
            "Vuthy", "Sophat", "Ravy", "Narin", "Pharith", "Channy", "Kiri", "Kravann", "Borey", "Sovann",
            "Sokheng", "Visal", "Seyha", "Tola", "Kagna", "Sovanna", "Nita", "Leakhena", "Chanrea", "Rithy",
            "Chomrong", "Darith", "Davuth", "Heng", "Kimsour", "Kunthea", "Mesa", "Nisay", "Panha", "Pech",
            "Pheakdei", "Phireak", "Pisey", "Ponleu", "Ratanak", "Roth", "Sakada", "Salim", "Sambath", "Sangva",
            "Sankranta", "Sanou", "Santepheap", "Sarath", "Saroeun", "Sathya", "Serey", "Sinath", "Sith", "Sivutha",
            "Sophal", "Sophoan", "Sorn", "Sorphiin", "Sothun", "Sovanara", "Sovanny", "Suchada", "Sun", "Suphana",
            "Suvan", "Tevy", "Tharith", "Thida", "Veasna", "Vibol", "Vichea", "Vicheka", "Visith", "Vutha"
        ];
        $khmerNames = [
            "សុខា", "បុប្ផា", "ចន្ថា", "តារា", "សុភា", "វណ្ណា", "ស៊ីណា", "រិទ្ធ", "ណារិទ្ធ", "ពិសិដ្ឋ",
            "ផាលី", "សុខ", "សៅ", "ជា", "មុនី", "រ័ត្ន", "ស្រី", "នីកា", "កុសល", "វីរៈ",
            "សុធី", "ផល្លា", "កល្យាណ", "កញ្ញា", "ម៉ាលៃ", "ចាន់ធូ", "សុខុម", "សំណាង", "ធីតា", "សារ៉ូ",
            "វុទ្ធី", "សុផាត", "រ៉ាវី", "ណារិន", "ផារិទ្ធ", "ចាន់នី", "គិរី", "ក្រវ៉ាន់", "បូរី", "សុវណ្ណ",
            "សុខហេង", "វិសាល", "សីហា", "តុលា", "កញ្ញា", "សុវណ្ណា", "នីតា", "លក្ខិណា", "ចន្ទ្រា", "រិទ្ធី",
            "ចំរើន", "ដារិទ្ធ", "ដាវុធ", "ហេង", "គីមសួរ", "គន្ធា", "មេសា", "និស្ស័យ", "បញ្ញា", "ពេជ្រ",
            "ភក្តី", "ភិរម្យ", "ពិសី", "ពន្លឺ", "រតនៈ", "រ៉ត", "សក្កដា", "សាលីម", "សម្បត្តិ", "សង្វារ",
            "សង្ក្រាន្ត", "សានូ", "សន្តិភាព", "សារ៉ាត់", "សារឿន", "សត្យា", "សេរី", "ស៊ីណាត", "សិទ្ធិ", "សីវុត្ថា",
            "សុផល", "សុភ័ណ្ឌ", "សន", "សុភិន", "សុធុន", "សុវណ្ណារ៉ា", "សុវណ្ណី", "សុជាតា", "ស៊ុន", "សុផាណា",
            "សុវណ្ណ", "ទេវី", "ថារិទ្ធ", "ធីតា", "វាសនា", "វិបុល", "វិជ្ជា", "វិច្ឆិកា", "វិសិដ្ឋ", "វុត្ថា"
        ];
        $roleNames = ["admin","manager","teacher","Supervisor","Vise President","General Staff","Student","Receptionist","Driver","Security"];
        for($i=1;$i<=3;$i++):
            $createData = [
                'locale'=>join(' ',[Arr::random($khmerNames),Arr::random($khmerNames)]),
                'name'=>join(' ',[Arr::random($englishNames),Arr::random($englishNames)]),
                'email'=>'ACE'.strval(Arr::random(range(10000,99999))),
                'password'=>Hash::make('123'),
            ];
            $user = User::create($createData);
            $user->assignRole('admin');
        endfor;
        // dd($data);

    }
}
