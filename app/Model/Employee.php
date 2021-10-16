<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'sallery', 'photo', 'nid',
    ];
}
