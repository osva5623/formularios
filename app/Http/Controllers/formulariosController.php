<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formulariosController extends Controller
{

    public function index($usuario)
    {
        return view('formularios',compact('usuario'));
    }

}
