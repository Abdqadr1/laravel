<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //test handlers

    public function test()
    {
        $name = request("name");
        $res = [
            "name" => $name,
            "type" => "laravel",
            "lang" => "php",
            "price" => 5,
            "fruits" => ["orange", "grape", "banana"]
        ];


        return view('test', $res);
    }

    public function wild($id)
    {
        $res = [
            "id" => $id,
        ];


        return view('wildcard', $res);
    }
}
