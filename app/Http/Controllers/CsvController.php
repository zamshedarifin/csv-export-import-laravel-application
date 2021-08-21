<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Imports\StudentImport;
use App\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    public function index()
    {
        $students= Student::latest()->get();
        return view('csv',compact('students'));
    }

    public function import(Request $request)
    {
        Excel::import(new StudentImport(),request()->file('file'));
        return back();
    }


    public function export(Request $request)
    {
        $student=$request->studentId;
        $data=array();
        if($student == null)
        {
            $data = [
                'error' => 'Please Select member'
            ];
            return redirect()->back()->with($data);
        }
        else{
            return Excel::download(new StudentExport($student),'report.xlsx');
        }
        return back();
    }


    //custom field import

    public function CustomImport(Request $request)
    {
        $data=array();
        $text=$request->your_field_name; //from input file name
        $number=$request->your_field_name;
        $status=$request->your_field_name;


        $rows = Excel::toArray(new ClassName, $request->file('file'));
        foreach ($rows as $value)
        {
            foreach($value as $arr)
            {

                //value from custom input field

                $data['text']=$text;
                $data['exam_id']=$number;
                $data['status']=$status;

                //Value Receive from excel sheet
                $data['name']=$arr['name'];
                $data['class']=$arr['class'];
                $data['roll']=$arr['roll'];

                YourModel::create($data);
            }

        }
        $data = [
            'success' => 'Data Imported Successfully.'
        ];
        return back()->with($data);
    }

}
