<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'photo', 'shopname',
    ];
}
