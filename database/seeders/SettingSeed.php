<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('truncate');

        $settings = [
            ["key" => "email", "value" => "chau@hotel-solution.co.tz"],
            ["key" => "website", "value" => "hotel-solution.co.tz"],
            [ "key" => "phone", "value" => "07774118877"],
            [ "key" => "box" , "value" => "P.O BOX 960"],
            [ "key" => "street" , "value" => "BWAWANI - MABLUU ROAD"],
            [  "key" => "state" , "value" => "ZANZIBAR - TANZANIA"],
            [ "key" => "tin", "value" => "44556"],
            [  "key" => "vrn", "value"  => "2233-221"],
            [  "key" => "zrb", "value" => "22339-5656"],
        ];
        foreach( $settings as $setting ){
            $rules = [
                'key' => 'required|unique:settings,key',
                'value' => 'required'
            ];

            $validate = Validator::make($setting, $rules);

            if( $validate->fails() ){
                continue;
            }
            Setting::create($setting);
        }

    }
}
