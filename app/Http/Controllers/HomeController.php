<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;

class HomeController extends Controller
{

    public function index()
    {
        return view('home.home');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data                     = new Student();
        $data->student_name       = $request->student_name;
        $data->student_department = $request->student_department;
        $data->student_institute  = $request->student_institute;
        $data->save();
        return response()->json($data);
    }


    public function show()
    {
        $data = Student::all();
        return response()->json($data);
    }


    public function edit($id)
    {
        $data   = Student::findOrFail($id);
        return response()->json(['student'=> $data]);
    }


    public function update(Request $request, $id)
    {

        $Student = Student::find($id);
        if(!$Student){
            return response()->json(['error'=>"Student not found"]);
        }

        $data =Student::find($id)->update([
            'student_name'=>$request->student_name,
            'student_department'=>$request->student_department,
            'student_institute'=>$request->student_institute
        ]);





//        $data                     = $this->get($request->$id);
//        $data->student_name       = $request->student_name;
//        $data->student_department = $request->student_department;
//        $data->student_institute  = $request->student_institute;
//        $data->save();

        return response()->json($data);
    }


    public function destroy($id)
    {
        $data = Student::findOrFail($id)->delete();
        return response()->json($data);
    }
}
