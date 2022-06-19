<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'party', 'category_id', 'start_date', 'end_date'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
