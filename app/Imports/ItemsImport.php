<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ItemsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
             '*.2' => 'required',
         ])->validate();

        foreach ($rows as $row) {
            Item::create([
                'name' => $row[2],
                'code' => $row[2],
                'desc' => $row[4] ?? null,
                'pref_supplier' => $row[6] ?? null,
                'selling_price' => $row[8] ?? 0,
                'gross_price' => $row[10] ?? 0,
            ]);
        }
    }
}

