<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'address','phone','photo','nid','salary','joining_date',
    ];

    public function sallery(){
        return $this->belongsTo(Salary::class);
    }
}
