<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait SalesCalculationsTrait

{

    public function calculateSubTotal(Collection $items){
        $sub_total = 0;
        foreach( $items as $item ){
        $sub_total += $item->pivot->due_price * $item->pivot->quantity;
        }
        return $sub_total;
    }



    public function total_item_income(Item $item){
        $item_cash = $item->selling_price * $item->pivot->quantity;   
        return $item_cash;
    }


    public function discounted($sale, $vat_rate){
        $discounted_income = $this->calculateSubTotal($sale->items) + (($vat_rate/100) * $this->calculateSubTotal($sale->items)) - $sale->discount;
        return $discounted_income;
    }



    public function vatTotal($items, $vat_rate){
        $vat_total = ($vat_rate/100) * $this->calculateSubTotal($items);
        return $vat_total;
    }




    /**
     *  After creating invoice
     *  Calculating sub-total
     */
    public static function calculateSubTotalAfter(Collection $items){
        $sub_total = 0;
        foreach( $items as $item ){
        $sub_total += ($item->pivot->due_price + $item->pivot->due_tax) * $item->pivot->quantity;
        }
        return $sub_total;
    }

    public static function vatTotalAfter($items, $vat_rate){
        $vat_total = ($vat_rate/100) * self::calculateSubTotalAfter($items);
        return $vat_total;
    }



    public static function discountedNetAfter($sale, $vat_rate){
        $discounted_income = self::calculateSubTotalAfter($sale->items) + (($vat_rate/100) * self::calculateSubTotalAfter($sale->items)) - $sale->discount;
        return $discounted_income;
    }


}









