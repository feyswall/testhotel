<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'payee',
        'payee_account',
        'category_id',
        'amount',
        'pay_date',
        'payment_method_id',
        'item',
        'desc',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
