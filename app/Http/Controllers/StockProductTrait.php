<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\InStock;
use Illuminate\Http\Request;
// use Illuminate\Support\Collection;


trait StockProductTrait

{

    public static function initialQuantity( InStock $inStock ){
        $initial_quantity = $inStock->quantity;
        return $initial_quantity;
    }

    public static function afterSaleQuantity( InStock $inStock ){
        $after_sale_quantity = $inStock->outStocks ? $inStock->outStocks->sum('quantity') : 0 ;
        return $after_sale_quantity;
    }

    public static function currentQuantity($inStock){
        $current_quantity = self::initialQuantity($inStock) - self::afterSaleQuantity($inStock);
        return $current_quantity;
    }

}









