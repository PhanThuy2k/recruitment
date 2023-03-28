<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancie extends Model
{
    use HasFactory;
    protected $fillable = ['code','name', 'status','career_id','department_id','description','position'];
    // đảo ngược của 1 nhiều
    public function getCareerName()
    { 
        return $this->belongsTo(Career::class, 'career_id');
    }
    public function getDepartmentName()
    { 
        return $this->belongsTo(department::class, 'department_id');
    }
     // tìm kiếm
     public function scopeSearch($query)
     {
       $query = $query->where('name','like','%'.request()->keyword.'%');
         return $query;
     }
}
