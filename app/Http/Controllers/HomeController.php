<?php

namespace App\Http\Controllers;

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
        echo "Hello";
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        echo "hello".$id;
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
