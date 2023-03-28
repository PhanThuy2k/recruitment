<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_requirement extends Model
{
    use HasFactory;
    protected $fillable = ['name','department_id','status'];
    public function scopeSearch($query)
    {
      $query = $query->where('name','like','%'.request()->keyword.'%');
        return $query; 
    }
    public function getDepartmentName()
    { 
        return $this->belongsTo(Department::class, 'department_id');
    }
}