<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Customer::create([
            'name' => 'fedric',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'ukonga dar',
            'email' => 'fed@gmail.com',
            'company' => 'nzasa ltd',
        ]);

        Customer::create([
            'name' => 'frenk',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'iringa ',
            'email' => 'frenk@gmail.com',
            'company' => 'omsi ltd',
        ]);

        Customer::create([
            'name' => 'dulla',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'mbeya',
            'email' => 'dulla@gmail.com',
            'company' => 'mbeya ltd',
        ]);

        Customer::create([
            'name' => 'dickson',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'ilamba',
            'email' => 'dics@gmail.com',
            'company' => 'nzasa ltd',
        ]);

        Customer::create([
            'name' => 'sarah',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'zenj',
            'email' => 'sarah@gmail.com',
            'company' => 'nzasa ltd',
        ]);

        Customer::create([
            'name' => 'inno',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'ukonga dar',
            'email' => 'inn@gmail.com',
            'company' => 'nzasa ltd',
        ]);

        Customer::create([
            'name' => 'suddy',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'ukonga dar',
            'email' => 'sud@gmail.com',
            'company' => 'nzasa ltd',
        ]);

        Customer::create([
            'name' => 'imma',
            'zrb' => '7688 9999 3889 8987',
            'phone' => '0657 46 773',
            'address' => 'ukonga dar',
            'email' => 'imma@gmail.com',
            'company' => 'nzasa ltd',
        ]);
    }
}
