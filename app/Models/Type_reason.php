<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_reason extends Model
{
    use HasFactory;
    protected $fillable = ['name','group_reason_types_id','status','description'];
    public function getTypeReasonName()
    { 
        return $this->belongsTo(Group_reason_type::class, 'group_reason_types_id');
    }
    public function scopeSearch($query)
    {
      $query = $query->where('name','like','%'.request()->keyword.'%');
        return $query;
    }
     
}
