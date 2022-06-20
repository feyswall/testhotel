<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'desc', 'type'];

    public function contracts(){
        return $this->hasMany(Contract::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

}
