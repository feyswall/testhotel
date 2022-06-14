<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'cash_mode', 'discount', 'invoice_number'];

    
    /**
     * The roles that belong to the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany( Item::class )->withPivot(
            'quantity',
            'invoice_mode',
            'due_price',
            'due_tax',
        )
        ->withTimestamps();
    }

    public function customer(){
        return $this->belongsTo( Customer::class );
    }

}