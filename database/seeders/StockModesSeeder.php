<?php

namespace Database\Seeders;

use App\Models\StockModes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockModesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $datas = [
        ['name' => 'expired', 'operation' => 0],
        ['name' => 'damaged', 'operation' => 0],
        ['name' => 'transfered', 'operation' => 0],
        ['name' => 'sold', 'operation' => 0],
        ['name' => 'receive_purchased', 'operation' => 1],
        ['name' => 'receive_transfered', 'operation' => 1],
        ['name' => 'receive_returned', 'operation' => 1]
    ];

    StockModes::insert( $datas );

    }    

}
