<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'status'];
    public function scopeSearch($query)
    {
        $query = $query->where('name', 'like', '%' . request()->keyword . '%');
        return $query;
    }
}
