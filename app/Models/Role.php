<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name'];

    public function employees()
    {
        return $this->morphedByMany(Employee::class, 'rolable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'rolable');
    }
}
