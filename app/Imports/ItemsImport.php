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
         $v = Validator::make($rows->toArray(), [
             '*.2' => 'required|string|unique:items,name',
             '*.4' => 'sometimes|string',
             '*.8' => 'required|numeric',
             '*.10' => 'required|numeric',
         ], $messages = [
             '*.2.required' => 'column :attribute doest Exist...',
            'unique' => 'Name at row :attribute aready exist...',
            '*.4.string' => 'Description in Row :attribute must be text',
            '*.8.numeric' => 'selling price at Row  :attribute must be Number',
            '*.10.numeric' => 'Gross price at Row :attribute must be Number',

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

