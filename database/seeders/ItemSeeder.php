<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'spoon',
            'selling_price' => '2000',
            'code' => '229hy',
            'tax' => '200',
        ]);

                Item::create([
            'name' => 'glass',
            'selling_price' => '20000',
            'code' => '229hy',
            'tax' => '2000',
        ]);

                Item::create([
            'name' => 'plates',
            'selling_price' => '400',
            'code' => '229hy',
            'tax' => '200',
        ]);

                        Item::create([
            'name' => 'knifes',
            'selling_price' => '8000',
            'code' => '229hy',
            'tax' => '2000',
        ]);

                                Item::create([
            'name' => 'tables',
            'selling_price' => '80000',
            'code' => '229hy',
            'tax' => '2000',
        ]);
    }
}
