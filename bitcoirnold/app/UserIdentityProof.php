<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserIdentityProof extends Model
{
    protected $table = 'user_idproofs';

    protected $fillable = ['user_id','gender','nationality','birthdate','employment_status','industry_type','job_position','company_name','id_type','expiry_date','id_number','image'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}