<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $append = ['photo'];

    protected $fillable = [
        'name', 'email', 'address','phone','photo','shopname',
    ];

    public function getPhotoAttribute()
    {
        return asset($this->attributes['photo']);
    }
}
