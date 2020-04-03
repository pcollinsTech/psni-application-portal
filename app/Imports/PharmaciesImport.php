<?php

namespace App\Imports;

use App\Pharmacy;
use Maatwebsite\Excel\Concerns\ToModel;

class PharmaciesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pharmacy([
            'registration_number' => $row['registration_number'],
            'trading_name' => $row['trading_name'], 
            'address_1' => $row['address_1'], 
            'address_2' => $row['address_2'], 
            'town' => $row['town'], 
            'post_code' => $row['post_code'], 
            'phone' => $row['phone'], 
            'website' => $row['website'], 
            'email' => $row['email'], 
        ]);
    }
}
