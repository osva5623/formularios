<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formulariosController extends Controller
{

    public function index($usuario)
    {
        dd($usuario);
        return view('formularios');
    }

}
