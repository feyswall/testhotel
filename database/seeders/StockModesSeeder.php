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
        ['name' => 'expired', 'operation' => 0, 'for_view' => 'expired'],
        ['name' => 'damaged', 'operation' => 0, 'for_view' => 'damaged'],
        ['name' => 'transfered', 'operation' => 0, 'for_view' => ''],
        ['name' => 'give', 'operation' => 0, 'for_view' => 'charity'],
        ['name' => 'sold', 'operation' => 0, 'for_view' => ''],
        ['name' => 'receive_purchased', 'operation' => 1, 'for_view' => ''],
        ['name' => 'receive_transfered', 'operation' => 1, 'for_view' => ''],
        ['name' => 'receive_returned', 'operation' => 1, 'for_view' => '']
    ];

    StockModes::insert( $datas );

    }    

}
