<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CursoController extends Controller
{
    public function index()
    {
        return view('admin.cursos.index');
    }
}