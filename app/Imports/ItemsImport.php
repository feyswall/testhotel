<?php

namespace App\Imports;

use App\Models\Item;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;


use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;


class ItemsImport implements ToModel, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {        
        foreach($row as $item){
            if($item != null){
                if($row[2] == null){
                    continue;
                }
                try{
                    return new Item([
                        'name' => $row[2],
                        'code' => $row[2],
                        'desc' => $row[4] ?? null,
                        'pref_supplier' => $row[6] ?? null,
                        'selling_price' => $row[8] ?? 0,
                        'gross_price' => $row[10] ?? 0,
                    ]);
                }catch(Exception $e){
                    error_log("Got an exception..".$e->getMessage());
                }
            }
        }

    }


     public function rules(): array
    {
        return [
            // '*.2' => 'exclude_if:*.8,null:*.10,null|required',
        ];
    }



}
