<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoControllerApi extends Controller
{

    public function index()
    {
        return Curso::all(); 
    }

    public function store(Request $request)
    {
        $novoCurso = Curso::create($req->all());
        return response($novoCurso,201); 
    }

    public function show($id)
    {
        $curso = Curso::find($id);
        if ( $curso <> null ) { 
            return response($curso,200);
        } else { 
            return response('',404); 
        } 
    }

    public function update(Request $request, $id)
    {
        if ( Curso::find($id)->update($req->all()) ) {
            return response('OK',200);
        } else { 
            return response('',404); 
        }
    }

    public function destroy($id)
    {
        $cursoEncontrado = Curso::find($id);
        if ( $cursoEncontrado ) {
            if ( $cursoEncontrado->delete() ) {
                return response('OK',200);
            } 
            else {
                return response('',400);
            }
        } else { 
            return response('',404); 
        }
    }
}
