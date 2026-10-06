<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use App\Library\Helper;
use App\Models\Staff;
use App\Models\Student\{Profile,Relative};
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\CountryCatalog\Entities;

use function PHPUnit\Framework\isEmpty;

class Student extends Component
{
    public function render()
    {
        return view('livewire.management.student');
    }

    public function load()
    {
        $zips = (new GetValueTextList)->convert(Entities\Zip::where('country_id',30)->get());
        $staffs = Staff::select('user_id as value','name_en as text')->get()->toArray();
        $shifts = Helper::getShift();
        return compact('zips','staffs','shifts');
    }

    public function datatable($page,$per_page,$filter)
    {
        return Profile::with([
            'staff',
            'motherInfo',
            'fatherInfo',
            'birthAddress.city',
            'birthAddress.state',
            'birthAddress.zip',
            'birthAddress.country',
            'currentAddress.city',
            'currentAddress.state',
            'currentAddress.zip',
            'currentAddress.country',
            ])->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function _create()
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

        $locationNames = [
            // --- Popular Districts & Areas (Phnom Penh & Siem Reap) ---
            "Daun Penh", "Chamkar Mon", "7 Makara", "Tuol Kouk", "Boeung Keng Kang",
            "Chroy Changvar", "Sen Sok", "Meanchey", "Chbar Ampov", "Pou Senchey",
            "Russey Keo", "Dangkao", "Kamboul", "Prek Pnov", "Puok",
            "Kralanh", "Soutr Nikum", "Prasat Bakong", "Srei Snam", "Banteay Srei",

            // --- Landmarks, Islands & Natural Sites ---
            "Angkor Wat", "Bayon Temple", "Phnom Kulen", "West Baray", "Tonle Sap",
            "Wat Phnom", "Independence Monument", "Central Market", "Phnom Bokor", "Teuk Chhou",
            "Koh Rong", "Koh Rong Sanloem", "Bousra Waterfall", "Veal Veng", "Phnom Sampeou",
            "Kamping Puoy", "Yeak Laom Lake", "Kirirom", "Preah Vihear Temple", "Koh Kong Krau",

            // --- Common Communes & Quarters (Sangkat / Khum) ---
            "Boeung Kak 1", "Boeung Kak 2", "Phsar Depo", "Teuk La-ak", "Phsar Doem Kor",
            "Phnom Penh Thmey", "Teuk Thla", "Obek Kaorm", "Steung Meanchey", "Prek Pra",
            "Veal Sbov", "Kakab", "Choam Chao", "Prek Leap", "Svay Dangkum",
            "Sala Kamreuk", "Wat Bo", "Slor Kram", "Chreav", "Kork Chak",

            // --- Notable Secondary Towns & Border Regions ---
            "Sisophon", "Mongkol Borei", "Preah Netr Preah", "Thmar Pouk", "Malai",
            "Anlong Veng", "Trapeang Prasat", "Samraong", "Choam Ksant", "Rovieng",
            "Tbeng Meanchey", "Sesan", "Siem Bouk", "Snuol", "Chhlong",
            "Sambour", "Koh Nhek", "Pech Chreada", "Lumphat", "Veun Sai"
        ];
        $jobTitles = [
            // --- Technology & IT ---
            "Software Engineer", "Frontend Developer", "Backend Developer", "Full Stack Engineer", "UI/UX Designer",
            "Data Analyst", "Systems Administrator", "IT Support Specialist", "DevOps Engineer", "QA Automation Engineer",

            // --- Management & Leadership ---
            "Project Manager", "Product Manager", "Operations Manager", "General Manager", "Team Lead",
            "Business Development Manager", "Regional Director", "Account Executive", "Chief Executive Officer", "Chief Technology Officer",

            // --- Marketing & Sales ---
            "Marketing Specialist", "Digital Marketing Manager", "Content Creator", "Social Media Coordinator", "SEO Specialist",
            "Sales Representative", "Key Account Manager", "Customer Success Specialist", "Public Relations Officer", "Brand Manager",

            // --- Finance & Legal ---
            "Accountant", "Financial Analyst", "Finance Manager", "Bookkeeper", "Internal Auditor",
            "Legal Counsel", "Compliance Officer", "Risk Analyst", "Tax Consultant", "Procurement Officer",

            // --- HR, Administration & Support ---
            "Human Resources Generalist", "HR Manager", "Talent Acquisition Specialist", "Administrative Assistant", "Office Manager",
            "Customer Service Representative", "Receptionist", "Operations Coordinator", "Executive Assistant", "Data Entry Specialist"
        ];
        $collection = [];
        for($i=0;$i<100;$i++){
            $data = [
                'name_kh'=>join(' ',[Arr::random($khmerNames),Arr::random($khmerNames)]),
                'name_en'=>join(' ',[Arr::random($englishNames),Arr::random($englishNames)]),
                'is_female'=>rand(0,1),
                'dob'=>\Carbon\Carbon::parse(join('-',[rand(1980,2020),str_pad(rand(1,12), 2, '0', STR_PAD_LEFT),str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)])),
                'class_room'=>rand(1,10),
                'staff'=>rand(1,2),
                'shift'=>rand(1,4),
                'identity'=>'ACE'.strval(Arr::random(range(10000,99999))),
                'cur'=>[
                    'street'=>Arr::random($locationNames),
                    'city'=>Arr::random($locationNames),
                    'state'=>Arr::random($locationNames),
                    'zip'=>rand(1,25)
                ],
                'birth'=>[
                    'street'=>Arr::random($locationNames),
                    'city'=>Arr::random($locationNames),
                    'state'=>Arr::random($locationNames),
                    'zip'=>rand(1,25)
                ],
                'father'=>[
                    'name'=>join(' ',[Arr::random($englishNames),Arr::random($englishNames)]),
                    'job'=>Arr::random($jobTitles),
                    'main_number'=>'0'. strval(rand(10000000,99999999)),
                    'subs_number'=>'0'. strval(rand(10000000,99999999))
                ],
                'mother'=>[
                    'name'=>join(' ',[Arr::random($englishNames),Arr::random($englishNames)]),
                    'job'=>Arr::random($jobTitles),
                    'main_number'=>'0'. strval(rand(10000000,99999999)),
                    'subs_number'=>'0'. strval(rand(10000000,99999999))
                ]
            ];
            $this->_create($data);
        }

    }

    public function create($data)
    {
        if(!empty(Arr::get($data,'birth.state')))
        {
            $birth_state_name = Str::of(Arr::get($data,'birth.state'))->lower()->snake();
            $birth_state = Entities\State::firstOrCreate(['name'=>$birth_state_name],['name'=>$birth_state_name,'zip_id'=>Arr::get($data,'birth.zip')]);
        }
        if(!empty(Arr::get($data,'birth.city')))
        {
            $birth_city_name = Str::of(Arr::get($data,'birth.city'))->lower()->snake();
            $birth_city = Entities\City::firstOrCreate(['name'=>$birth_city_name],['name'=>$birth_city_name,'state_id'=>$birth_state->id]);
        }

        if(!empty(Arr::get($data,'birth.street')))
        {
            $birth_street_name = Str::of(Arr::get($data,'birth.street'))->lower()->snake();
            $birth_street = Entities\Street::firstOrCreate(['name'=>$birth_street_name],['name'=>$birth_street_name,'city_id'=>$birth_city->id]);
        }
        if(!empty(Arr::get($data,'cur.state')))
        {
            $current_state_name = Str::of(Arr::get($data,'cur.state'))->lower()->snake();
            $current_state = Entities\State::firstOrCreate(['name'=>$current_state_name],['name'=>$current_state_name,'zip_id'=>Arr::get($data,'cur.zip')]);
        }
        if(!empty(Arr::get($data,'cur.city')))
        {
            $current_city_name = Str::of(Arr::get($data,'cur.city'))->lower()->snake();
            $current_city = Entities\City::firstOrCreate(['name'=>$current_city_name],['name'=>$current_city_name,'state_id'=>$current_state->id]);
        }

        if(!empty(Arr::get($data,'cur.street')))
        {
            $current_street_name = Str::of(Arr::get($data,'cur.street'))->lower()->snake();
            $current_street = Entities\Street::firstOrCreate(['name'=>$current_street_name],['name'=>$current_street_name,'city_id'=>$current_city->id]);
        }
        if(!empty(Arr::get($data,'father.name')))
        {
            $father = Relative::create([
                'name'=>Arr::get($data,'father.name'),
                'job'=>Arr::get($data,'father.job'),
                'main_number'=>Arr::get($data,'father.main_number'),
                'subs_number'=>Arr::get($data,'father.subs_number'),
            ]);
        }

        if(!empty(Arr::get($data,'mother.name')))
        {
            $mother = Relative::create([
                'name'=>Arr::get($data,'mother.name'),
                'job'=>Arr::get($data,'mother.job'),
                'main_number'=>Arr::get($data,'mother.main_number'),
                'subs_number'=>Arr::get($data,'mother.subs_number'),
            ]);
        }

        if(!empty(Arr::get($data,'name_en')) && !empty(Arr::get($data,'dob')))
        {
            Profile::create([
                'name_kh'=>Arr::get($data,'name_kh'),
                'name_en'=>Arr::get($data,'name_en'),
                'is_female'=>Arr::get($data,'is_female'),
                'date_of_birth'=>Arr::get($data,'dob'),
                'other'=>Arr::get($data,'other',null),
                'room'=>Arr::get($data,'class_room',null),
                'staff_id'=>Arr::get($data,'staff',null),
                'shift'=>Arr::get($data,'shift',null),
                'identity'=>Arr::get($data,'identity',null),
                'father_id'=>$father ? $father->id:null,
                'mother_id'=>$mother ? $mother->id:null,
                'birth_address_id'=> $birth_street ? $birth_street->id:null,
                'current_address_id'=> $current_street ? $current_street->id:null
            ]);
            return ['status'=>true,'message'=>'Created student successfull!'];
        }else{
            if(empty(Arr::get($data,'name_en')))
                return ['status'=>false,'message'=>'Need to assign name for student.'];
            if(empty(Arr::get($data,'gender')))
                return ['status'=>false,'message'=>'Need to assign gender for student.'];
            if(empty(Arr::get($data,'dob')))
                return ['status'=>false,'message'=>'Need to assign date of birth for student.'];
        }
    }

    public function updateRecord($data)
    {
        if(!empty(Arr::get($data,'birth_address.state.name')))
        {
            $birth_state_name = Str::of(Arr::get($data,'birth_address.state.name'))->lower()->snake();
            $birth_state = Entities\State::firstOrCreate(['name'=>$birth_state_name],['name'=>$birth_state_name,'zip_id'=>Arr::get($data,'birth_address.zip')]);
        }
        if(!empty(Arr::get($data,'birth_address.city.name')))
        {
            $birth_city_name = Str::of(Arr::get($data,'birth_address.city.name'))->lower()->snake();
            $birth_city = Entities\City::firstOrCreate(['name'=>$birth_city_name],['name'=>$birth_city_name,'state_id'=>$birth_state->id]);
        }

        if(!empty(Arr::get($data,'birth_address.name')))
        {
            $birth_street_name = Str::of(Arr::get($data,'birth_address.name'))->lower()->snake();
            $birth_street = Entities\Street::firstOrCreate(['name'=>$birth_street_name],['name'=>$birth_street_name,'city_id'=>$birth_city->id]);
        }
        if(!empty(Arr::get($data,'current_address.state.name')))
        {
            $current_state_name = Str::of(Arr::get($data,'current_address.state.name'))->lower()->snake();
            $current_state = Entities\State::firstOrCreate(['name'=>$current_state_name],['name'=>$current_state_name,'zip_id'=>Arr::get($data,'current_address.zip')]);
        }
        if(!empty(Arr::get($data,'current_address.city.name')))
        {
            $current_city_name = Str::of(Arr::get($data,'current_address.city.name'))->lower()->snake();
            $current_city = Entities\City::firstOrCreate(['name'=>$current_city_name],['name'=>$current_city_name,'state_id'=>$current_state->id]);
        }

        if(!empty(Arr::get($data,'current_address.name')))
        {
            $current_street_name = Str::of(Arr::get($data,'current_address.name'))->lower()->snake();
            $current_street = Entities\Street::firstOrCreate(['name'=>$current_street_name],['name'=>$current_street_name,'city_id'=>$current_city->id]);
        }
        if(!empty(Arr::get($data,'father_info.name')))
        {
            $father = Relative::updateOrCreate(['id'=>Arr::get($data,'father_id')],
            [
                'name'=>Arr::get($data,'father_info.name'),
                'job'=>Arr::get($data,'father_info.job'),
                'main_number'=>Arr::get($data,'father_info.main_number'),
                'subs_number'=>Arr::get($data,'father_info.subs_number'),
            ]);
        }

        if(!empty(Arr::get($data,'mother_info.name')))
        {
            $mother = Relative::updateOrCreate(['id'=>Arr::get($data,'mother_id')],
            [
                'name'=>Arr::get($data,'mother_info.name'),
                'job'=>Arr::get($data,'mother_info.job'),
                'main_number'=>Arr::get($data,'mother_info.main_number'),
                'subs_number'=>Arr::get($data,'mother_info.subs_number'),
            ]);
        }
        if(!empty(Arr::get($data,'name_en')) && !empty(Arr::get($data,'gender')) && !empty(Arr::get($data,'date_of_birth')))
        {
            Profile::where('id',Arr::get($data,'id'))
                ->update([
                'name_kh'=>Arr::get($data,'name_kh'),
                'name_en'=>Arr::get($data,'name_en'),
                'gender'=>Arr::get($data,'gender'),
                'date_of_birth'=>Arr::get($data,'date_of_birth'),
                'other'=>Arr::get($data,'other',null),
                'room'=>Arr::get($data,'room',null),
                'staff_id'=>Arr::get($data,'staff_id',null),
                'father_id'=>isset($father) ? $father->id:null,
                'mother_id'=>isset($mother) ? $mother->id:null,
                'shift'=>Arr::get($data,'shift',null),
                'identity'=>Arr::get($data,'identity',null),
                'birth_address_id'=> $birth_street ? $birth_street->id:null,
                'current_address_id'=> $current_street ? $current_street->id:null,
            ]);
            return ['status'=>true,'message'=>'Created student successfull!'];
        }else{
            if(empty(Arr::get($data,'name_en')))
                return ['status'=>false,'message'=>'Need to assign name for student.'];
            if(empty(Arr::get($data,'gender')))
                return ['status'=>false,'message'=>'Need to assign gender for student.'];
            if(empty(Arr::get($data,'dob')))
                return ['status'=>false,'message'=>'Need to assign date of birth for student.'];
        }
    }

    public function deleteRecord($param)
    {
        Profile::where('id',$param)->delete();
    }
}
