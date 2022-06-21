<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxes')->delete();

        $items = [
          ['name' => 'ZRB-supply of taxable goods and services in Zanzibar', 'type' => 1, 'rate' => 15 ], 
        ];

        foreach( $items as $item ){
            Tax::create($item);
        }
    }
}
