<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone'];

    use HasFactory;
    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
