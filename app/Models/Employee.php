<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $casts = [
        // 'status' => 'boolean'
    ];
    protected $fillable = ["name", 'email', 'status', 'salary', 'address', ''];

    public function address()
    {
        return $this->hasOne(Address::class, 'emp_id')->withDefault([
            'street' => '',
            'country' => ''
        ]);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_for');
    }
    public function setAddress($values)
    {
        if ($this->address()->exists()) {
            $this->address()->update($values);
        } else {
            $this->address()->create($values);
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role');
    }
}
