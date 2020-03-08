<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    function index(){
        return "resr";
    }

    function show($id){
    echo $id;
    }
}
