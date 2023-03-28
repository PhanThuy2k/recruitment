<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_recruitment_round extends Model
{
    use HasFactory;
    protected $fillable = ['code','name','type_of_recruitment_round_id','status','description'];
    public function getAddRecruitmentRoundName()
    { 
        return $this->belongsTo(Type_of_recruitment_round::class, 'type_of_recruitment_round_id');
    }
    public function scopeSearch($query)
    {
      $query = $query->where('name','like','%'.request()->keyword.'%');
        return $query;
    }
}
  