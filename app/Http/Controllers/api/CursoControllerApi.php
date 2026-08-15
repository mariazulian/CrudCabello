<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoControllerApi extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Curso::all(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $novoCurso = Curso::create($req->all());
        return response($novoCurso,201); 
        //aqui é uma boa prática para retornar o registro em JSON com codigo http 201 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        if ( $curso <> null ) { // status http 200 se OK,
            return response($curso,200);
        } else { 
            return response('',404); 
        } // 404 se não encontrou
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ( Curso::find($id)->update($req->all()) ) {
            return response('OK',200);
        } else { 
            return response('',404); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
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
