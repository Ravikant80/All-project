<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityProof extends Model
{
    protected $table = 'identity_proofs';

    protected $fillable = ['name','status'];

}