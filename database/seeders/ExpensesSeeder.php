<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;


class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

            if( $validate->fails() ){
                continue;
            }

            Category::create($item);
        }
    }
}
