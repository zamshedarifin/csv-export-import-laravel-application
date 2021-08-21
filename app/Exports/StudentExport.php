<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromQuery,WithHeadings
{

    public $data=array();
    public function __construct($data){
        $this->data = $data;
    }

    public function query()
    {
        return Student::query()->select('name','email','mobile','roll')->whereIn('id',$this->data)->orderBy('id','asc');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Roll',
        ];
    }
}
