<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'BANK PAYMENT'],
            ['name' => 'CASH PAYMENT'],
        ];

        DB::table('payment_methods')->delete();

        foreach ($items as  $item) {
            PaymentMethod::create($item);
        }
    }
}
