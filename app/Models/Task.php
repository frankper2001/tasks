<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    //campos de BDD donde se permite asignacion masiva
    protected $fillable = ['title', 'description', 'category', 'importance', 'imagen'];
}
