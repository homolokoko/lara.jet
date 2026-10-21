<?php
namespace App\Library;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Helper{


    public function getType($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'Monthly'],
            ['value'=>2,'text'=>'Semester'],
            ['value'=>3,'text'=>'Final']
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getShift($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'07:30-10:30'],
            ['value'=>2,'text'=>'01:30-04:30'],
            ['value'=>3,'text'=>'05:30-06:30'],
            ['value'=>4,'text'=>'06:30-07:30'],
        ]);

        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getDay($val=null){
        $collection = collect([
            ['value'=>1,'text'=>'Sunday'],
            ['value'=>2,'text'=>'Monday'],
            ['value'=>3,'text'=>'Tueday'],
            ['value'=>4,'text'=>'Wednesday'],
            ['value'=>5,'text'=>'Thursday'],
            ['value'=>6,'text'=>'Friday'],
            ['value'=>7,'text'=>'Saturday']
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getMonth($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'January'],
            ['value'=>2,'text'=>'Fabrary'],
            ['value'=>3,'text'=>'March'],
            ['value'=>4,'text'=>'April'],
            ['value'=>5,'text'=>'May'],
            ['value'=>6,'text'=>'June'],
            ['value'=>7,'text'=>'July'],
            ['value'=>8,'text'=>'August'],
            ['value'=>9,'text'=>'September'],
            ['value'=>10,'text'=>'October'],
            ['value'=>11,'text'=>'November'],
            ['value'=>12,'text'=>'December'],
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getYear()
    {
        $current_year = \Carbon\Carbon::now()->year;
        return range($current_year-10,$current_year+10);
    }

    public function getStudyPeriod()
    {
        $current_year = \Carbon\Carbon::now()->year;
        $ranges = range($current_year,$current_year+10);
        return collect($ranges)->map(fn($item)=>(($item-1).'-'.$item));
    }


    public function getLevel()
    {
        return range(1,6);
    }

    public function getEducationLevel($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'Secondary Education (Grades 7-9)'],
            ['value'=>2,'text'=>'Upper Secondary (Grades 10-12)'],
            ['value'=>3,'text'=>'Diploma'],
            ['value'=>4,'text'=>'Associate Degree'],
            ['value'=>5,'text'=>'Bachelor\'s Degree'],
            ['value'=>6,'text'=>'Master\'s Degree'],
            ['value'=>7,'text'=>'Doctorate/Ph.D.'],
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getRelative($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'Mother'],
            ['value'=>2,'text'=>'Father'],
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getCountry($val=null)
    {
        $collection = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BQ' => 'Bonaire, Sint Eustatius and Saba',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'CV' => 'Cabo Verde',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, Democratic Republic of the',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => "Côte d'Ivoire",
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CW' => 'Curaçao',
            'CY' => 'Cyprus',
            'CZ' => 'Czechia',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'SZ' => 'Eswatini',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'VA' => 'Holy See',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => "Korea, Democratic People's Republic of",
            'KR' => 'Korea, Republic of',
            'XK' => 'Kosovo',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => "Lao People's Democratic Republic",
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MK' => 'North Macedonia',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestine, State of',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Réunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthélemy',
            'SH' => 'Saint Helena, Ascension and Tristan da Cunha',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin (French part)',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SX' => 'Sint Maarten (Dutch part)',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and the South Sandwich Islands',
            'SS' => 'South Sudan',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Türkiye',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands (British)',
            'VI' => 'Virgin Islands (U.S.)',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        ];
        if(!$val || $val===0)
            return $collection;
        return $collection[$val];
    }

    public function getState()
    {
        return [
            'KH-1'  => 'Banteay Meanchey',
            'KH-2'  => 'Battambang',
            'KH-3'  => 'Kampong Cham',
            'KH-4'  => 'Kampong Chhnang',
            'KH-5'  => 'Kampong Speu',
            'KH-6'  => 'Kampong Thom',
            'KH-7'  => 'Kampot',
            'KH-8'  => 'Kandal',
            'KH-9'  => 'Koh Kong',
            'KH-10' => 'Kratie',
            'KH-11' => 'Mondulkiri',
            'KH-12' => 'Phnom Penh',
            'KH-13' => 'Preah Vihear',
            'KH-14' => 'Prey Veng',
            'KH-15' => 'Pursat',
            'KH-16' => 'Ratanakiri',
            'KH-17' => 'Siem Reap',
            'KH-18' => 'Preah Sihanouk',
            'KH-19' => 'Stung Treng',
            'KH-20' => 'Svay Rieng',
            'KH-21' => 'Takeo',
            'KH-22' => 'Oddar Meanchey',
            'KH-23' => 'Kep',
            'KH-24' => 'Pailin',
            'KH-25' => 'Tboung Khmum',
        ];
    }

}
