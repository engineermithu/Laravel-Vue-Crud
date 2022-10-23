<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use File;

class StudentRepository implements StudentRepositoryInterface
{

    public function show()
    {
        return Student::all();
    }

    public function store($request){

        $imageName = '';
        if($student_image = $request->file('student_image')){
            $imageName = time().'-'.uniqid().'.'. $student_image->getClientOriginalExtension();
            $student_image->move('images/students',$imageName);
//            $student_image->move('../../../../../images/students',$imageName);

        }
        $data                     = new Student();
        $data->student_name       = $request->student_name;
        $data->student_department = $request->student_department;
        $data->student_institute  = $request->student_institute;
        $data->student_image      = $imageName;
        $data->save();
        return response()->json([
            'status' => 200, $data
        ]);
    }

    public function edit($id)
    {
        return Student::findOrFail($id);
    }

    public function update($request, $id){

        $data                     = Student::find($id);
        $deleteOldImage = 'images/students/'.$data->student_image;
        if($request->hasFile('student_image')) {

            $student_image = $request->file('student_image');
            if(file_exists($deleteOldImage)){
                File::delete($deleteOldImage);
            }
            $imageName = time() . '-' . uniqid() . '.' . $student_image->getClientOriginalExtension();
            $student_image->move('images/students', $imageName);

//            if (file_exists(public_path($imageName =  $student_image->getClientOriginalName())))
//            {
//                unlink(public_path($imageName));
//            }

        }
        else
        {
            $imageName = $request->student_image;
        }

        $data->student_name       = $request->student_name;
        $data->student_department = $request->student_department;
        $data->student_institute  = $request->student_institute;
        $data->student_image      = $imageName;
        $data->update();
        return response()->json([
            'status' => 200, $data
        ]);
    }

    public function destroy($id){

        $data = Student::findOrFail($id);
        $deleteOldImage = 'images/students/'.$data->student_image;
        if(file_exists($deleteOldImage)){
            File::delete($deleteOldImage);
        }
        return response()->json([
            'status' => 200, $data->delete()
        ]);
    }


}
