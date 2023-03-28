<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview_question extends Model
{
    use HasFactory;
    protected $fillable = ['description','set_of_interview_question_id','status'];
    public function getInterviewQuestionName()
    { 
        return $this->belongsTo(Set_of_interview_question::class, 'set_of_interview_question_id');
    }
    public function scopeSearch($query)
    {
      $query = $query->where('description','like','%'.request()->keyword.'%');
        return $query;
    }
}
 