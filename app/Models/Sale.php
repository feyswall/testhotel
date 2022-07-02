<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'stock_id',
     'payment_method_id','cash_mode', 'discount',
      'invoice_number', 'pi_number', 'validity', 'due_date', 'vat'];

    
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
        )
        ->withTimestamps();
    }

    public function customer(){
        return $this->belongsTo( Customer::class );
    }

    public function payment_method(){
        return $this->belongsTo( PaymentMethod::class );
    }

    public function stock(){
        return $this->belongsTo( Stock::class );
    }

    public function stock_issuings(){
        return $this->hasMany( StockIssuing::class );
    }

}