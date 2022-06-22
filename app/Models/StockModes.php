<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockModes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'operation'];
}
