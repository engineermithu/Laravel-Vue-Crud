<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{
    public function show();

    public function store(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);

    public function edit($id);




}
