<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Student([
            'name'     => $row['name'],
            'email'     => $row['email'],
            'roll'    => $row['roll'],
            'mobile'    => $row['mob'],
        ]);
    }
}
