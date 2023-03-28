<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample_email extends Model
{
    use HasFactory;
    protected $fillable = ['title','name','description','candidate_id','name_HR','vacancie_id','address'];
    public function getVacancieName()
    { 
        return $this->belongsTo(Vacancie::class, 'vacancie_id');
    }
    public function getCandidateName()
    { 
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
    public function scopeSearch($query)
    {
      $query = $query->where('name','like','%'.request()->keyword.'%');
        return $query;
    }
}
					    