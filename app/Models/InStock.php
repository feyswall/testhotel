<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InStock extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'date_in', 'old_item_price', 
    'stock_id', 'item_id', 'item_stock_id'. 'stock_mode_id', 'in_from'];

    public function stock(){
        return $this->belongsTo( stock::class );
    }

    public function item(){
        return $this->belongsTo( Stock::class );
    }
}
