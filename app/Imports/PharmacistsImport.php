<?php

namespace App\Imports;

use App\Pharmaist;
use Maatwebsite\Excel\Concerns\ToModel;

class PharmacistsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pharmaist([
            'title' => $row['title'],
            'forenames' => $row['forenames'], 
            'surname' => $row['surname'], 
            'registration_number' => $row['registration_number'], 
            'date_registered' => $row['date_registered'], 
            'verified' => $row['verified'], 
        ]);
    }
}
