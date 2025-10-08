<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        $states = [
            ['id'=>1, 'name'=>'Andhra Pradesh', 'iso2'=>'IN‑AP', 'country_id'=>101, 'status'=>'1'],
            ['id'=>2, 'name'=>'Arunachal Pradesh', 'iso2'=>'IN‑AR', 'country_id'=>101, 'status'=>'1'],
            ['id'=>3, 'name'=>'Assam', 'iso2'=>'IN‑AS', 'country_id'=>101, 'status'=>'1'],
            ['id'=>4, 'name'=>'Bihar', 'iso2'=>'IN‑BR', 'country_id'=>101, 'status'=>'1'],
            ['id'=>5, 'name'=>'Chhattisgarh', 'iso2'=>'IN‑CT', 'country_id'=>101, 'status'=>'1'],
            ['id'=>6, 'name'=>'Goa', 'iso2'=>'IN‑GA', 'country_id'=>101, 'status'=>'1'],
            ['id'=>7, 'name'=>'Gujarat', 'iso2'=>'IN‑GJ', 'country_id'=>101, 'status'=>'1'],
            ['id'=>8, 'name'=>'Haryana', 'iso2'=>'IN‑HR', 'country_id'=>101, 'status'=>'1'],
            ['id'=>9, 'name'=>'Himachal Pradesh', 'iso2'=>'IN‑HP', 'country_id'=>101, 'status'=>'1'],
            ['id'=>10, 'name'=>'Jharkhand', 'iso2'=>'IN‑JH', 'country_id'=>101, 'status'=>'1'],
            ['id'=>11, 'name'=>'Karnataka', 'iso2'=>'IN‑KA', 'country_id'=>101, 'status'=>'1'],
            ['id'=>12, 'name'=>'Kerala', 'iso2'=>'IN‑KL', 'country_id'=>101, 'status'=>'1'],
            ['id'=>13, 'name'=>'Madhya Pradesh', 'iso2'=>'IN‑MP', 'country_id'=>101, 'status'=>'1'],
            ['id'=>14, 'name'=>'Maharashtra', 'iso2'=>'IN‑MH', 'country_id'=>101, 'status'=>'1'],
            ['id'=>15, 'name'=>'Manipur', 'iso2'=>'IN‑MN', 'country_id'=>101, 'status'=>'1'],
            ['id'=>16, 'name'=>'Meghalaya', 'iso2'=>'IN‑ML', 'country_id'=>101, 'status'=>'1'],
            ['id'=>17, 'name'=>'Mizoram', 'iso2'=>'IN‑MZ', 'country_id'=>101, 'status'=>'1'],
            ['id'=>18, 'name'=>'Nagaland', 'iso2'=>'IN‑NL', 'country_id'=>101, 'status'=>'1'],
            ['id'=>19, 'name'=>'Odisha', 'iso2'=>'IN‑OR', 'country_id'=>101, 'status'=>'1'],
            ['id'=>20, 'name'=>'Punjab', 'iso2'=>'IN‑PB', 'country_id'=>101, 'status'=>'1'],
            ['id'=>21, 'name'=>'Rajasthan', 'iso2'=>'IN‑RJ', 'country_id'=>101, 'status'=>'1'],
            ['id'=>22, 'name'=>'Sikkim', 'iso2'=>'IN‑SK', 'country_id'=>101, 'status'=>'1'],
            ['id'=>23, 'name'=>'Tamil Nadu', 'iso2'=>'IN‑TN', 'country_id'=>101, 'status'=>'1'],
            ['id'=>24, 'name'=>'Telangana', 'iso2'=>'IN‑TG', 'country_id'=>101, 'status'=>'1'],
            ['id'=>25, 'name'=>'Tripura', 'iso2'=>'IN‑TR', 'country_id'=>101, 'status'=>'1'],
            ['id'=>26, 'name'=>'Uttar Pradesh', 'iso2'=>'IN‑UP', 'country_id'=>101, 'status'=>'1'],
            ['id'=>27, 'name'=>'Uttarakhand', 'iso2'=>'IN‑UT', 'country_id'=>101, 'status'=>'1'],
            ['id'=>28, 'name'=>'West Bengal', 'iso2'=>'IN‑WB', 'country_id'=>101, 'status'=>'1'],
            // you can also add union territories similarly
        ];

        foreach ($states as $s) {
            State::updateOrCreate(['id' => $s['id']], $s);
        }
    }
}
