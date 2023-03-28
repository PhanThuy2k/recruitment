<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment_channel extends Model
{
    use HasFactory;
    protected $fillable = ['name','candidate_source_id','status','description'];
    public function getRecruitmentChannelName()
    { 
        return $this->belongsTo(Candidate_source::class, 'candidate_source_id');
    }
    // tìm kiếm
    public function scopeSearch($query)
    {
      $query = $query->where('name','like','%'.request()->keyword.'%');
        return $query;
    }
}
