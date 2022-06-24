<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutStock extends Model
{
    use HasFactory;

    protected $fillable = ['in_stock_id', 'quantity', 'date_out',
         'stock_mode_in', 'out_to'];

    public function inStock(){
        return $this->belongsTo( InStock::class );
    }
}
