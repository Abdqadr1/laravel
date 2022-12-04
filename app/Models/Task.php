<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'deadline', 'task_for'];

    public function owner()
    {
        return $this->belongsTo(Employee::class, 'task_for');
    }
}
