<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'desc'];

    /**
     * The items that belong to the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function inStock(){
        return $this->hasMany( InStock::class );
    }

    public function sales(){
        return $this->hasMany( Sale::class );
    }
}
