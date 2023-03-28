<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefits_enjoyed extends Model
{
    use HasFactory;
    protected $fillable = ['code','name','content','object','status'];
}
