<?php
namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
    
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


      //  print_r($row);
      //  die;
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'], 
           // 'password' => \Hash::make($row['password']),
        ]);
    }

}
