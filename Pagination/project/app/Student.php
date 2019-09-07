<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstName', 'lastName','email', 'password',
    ];
    
    protected $table = 'students';
}
