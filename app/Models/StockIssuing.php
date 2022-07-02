<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIssuing extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'item_id', 'quantity', 'in_stock_id'];

    public function sale(){
        return $this->belongsTo( Sale::class );
    }
}
