<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->delete();

        $items = [
            ['name' => 'SALARY', 'desc' => 'salary', 'type' => 2],
            ['name' => 'PETTY CASH', 'desc' => 'petty cash', 'type' => 2],
            ['name' => 'OPERATION COST', 'desc' => 'operation cost', 'type' => 2],
            ['name' => 'TRANSPORTATION', 'desc' => 'transportation', 'type' => 2],
            ['name' =>'RENT', 'desc' => 'rent', 'type' => 2],
            ['name' => 'DIRECTORS ALLOWANCE', 'desc' => 'directors allowance', 'type' => 2],
            ['name' => 'EMPLOYEES ALLOWANCE', 'desc' => 'employees allowance', 'type' => 2],
            ['name' => 'COMPLEMENTARY ALLOWANCE', 'desc' => 'complementary allowance', 'type' => 2],
            ['name' => 'MISCELLANEOUS', 'desc' => 'miscellaneous', 'type' => 2],
        ];

        foreach ( $items as $item ){
            $rules = [
                'name' => 'required|unique:categories,name',
            ];
            $validate = Validator::make($items, $rules);
            Category::create($item);
        }




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
            Category::create($item);
        }


    }
}
