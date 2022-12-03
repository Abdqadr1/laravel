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

    public function address()
    {
        return $this->hasOne(Address::class, 'emp_id')->withDefault([
            'street' => '',
            'country' => ''
        ]);
    }
}
