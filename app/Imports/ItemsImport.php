<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;


use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

use Maatwebsite\Excel\Concerns\SkipsEmptyRows;


class ItemsImport implements ToModel, WithValidation, SkipsEmptyRows
{
        use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'name' => $row[2],
            'code' => $row[2],
            'desc' => $row[4] ?? null,
            'pref_supplier' => $row[6] ?? null,
            'selling_price' => $row[8] ?? 0,
            'gross_price' => $row[10] ?? 0,
        ]);
    }


    public function rules(): array
    {
         return [
            '*.2' => [
                'required',
                'string',
            ],
        ];
    }

}
