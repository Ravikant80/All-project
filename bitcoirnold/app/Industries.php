<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industries extends Model
{
    protected $table = 'industries';

    protected $fillable = ['name','status'];

}