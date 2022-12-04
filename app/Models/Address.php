<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['street', 'country'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, "emp_id", "id");
    }
}
