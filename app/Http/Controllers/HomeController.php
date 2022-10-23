<?php

namespace App\Http\Controllers;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student){
         $this->student = $student;
    }


    public function index()
    {
        return view('home.home');
    }

    public function store(Request $request)
    {
         $this->student->store($request);
    }

    public function show()
    {
       $data = $this->student->show();
        return response()->json($data);
    }

    public function edit($id)
    {
        $data = $this->student->edit($id);
        return response()->json(['student'=> $data]);
    }

    public function update(Request $request, $id)
    {
        $this->student->update($request, $id);
    }

    public function destroy($id)
    {
        $this->student->destroy($id);
    }
}
