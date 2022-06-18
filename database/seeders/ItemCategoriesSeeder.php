<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ItemCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $items = [
            ['name' => 'KITCHEN', 'desc' => 'kitchen', 'type' => 1],
            ['name' => 'RESTAURANT', 'desc' => 'restaurant', 'type' => 1],
            ['name' => 'BAR', 'desc' => 'bar', 'type' => 1],
            ['name' => 'LAUNDRY', 'desc' => 'laundry', 'type' => 1],
            ['name' =>'POOL', 'desc' => 'pool', 'type' => 1],
            ['name' => 'PET FOOD STUFF', 'desc' => 'pet food stuff', 'type' => 1],
        ];

        foreach ( $items as $item ){
            $rules = [
                'name' => 'required|unique:categories,name',
            ];

            $validate = Validator::make($items, $rules);

            if( $validate->fails() ){
                continue;
            }

            Category::create($item);
        }
    }
}
