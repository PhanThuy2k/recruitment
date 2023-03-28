<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $table = 'careers';

    protected $fillable = ['code','name','status','description'];
    // tìm kiếm

    public function scopeSearch($query)
    {
      if (request()->keyword) {
        $query = $query->where('name','like','%'.request()->keyword.'%');
      }
      return $query;
      
    }
     
}

