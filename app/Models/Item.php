<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'selling_price', 'code', 'desc', 'pref_supplier', 'gross_price'];


        /**
     * The roles that belong to the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales()
    {
        return $this->belongsToMany( Sale::class )->withPivot(
            'quantity',
            'invoice_mode',
            'due_price',
        );
    }

    /**
     * The stocks that belong to the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stocks()
    {
        return $this->belongsToMany(Stock::class);
    }

}