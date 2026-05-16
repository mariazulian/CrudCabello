<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\Storage; 

class CursoController extends Controller
{
    
    public function index(){ 
        $rows = Curso::all();
        return view('admin.cursos.index', compact('rows')); 
    } 

    public function adicionar() {
        return view('admin.cursos.adicionar');
    }
    public function editar($id) {

        $linha = Curso::find($id);
        return view('admin.cursos.editar',compact('linha'));
    // manda o registro encontrado para ser editado na visão
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();
        if(isset($dados['publicado'])){
            $dados['publicado'] = 'sim';
        }else{
            $dados['publicado'] = 'nao';
        }
        if($req->hasFile('arquivo')){
            $imagem = $req->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/cursos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem'] = $dir."/".$nomeImagem;
        }
        Curso::create($dados);
        return redirect()->route('admin.cursos');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();
        if(isset($dados['publicado'])){
            $dados['publicado'] = 'sim';
        }else{
            $dados['publicado'] = 'nao';
        }
        if($req->hasFile('arquivo')){ // o upload chegou ?
            $imagem = $req->file('arquivo'); // pega arquivo de imagem
            $num = rand(1111,9999);// escolhe numero pra não repetir
            $dir = "img/cursos/"; // pasta de imagens
            $ex = $imagem->guessClientExtension(); // pega extensão, jpg, png ...
            $nomeImagem = "imagem_".$num.".".$ex; // monta novo nome
            $imagem->move($dir,$nomeImagem); // move pro lugar correto e novo nome
            $dados['imagem'] = $dir."/".$nomeImagem; // salva no campo imagem   
        }
        Curso::find($id)->update($dados);
        return redirect()->route('admin.cursos');
    }

    public function excluir($id) {
        
    Curso::find($id)->delete();
    // apos selecionar o registro, é chamado o
    // método DELETE do OBJETO registro
    return redirect()->route('admin.cursos');
    // abre a visão da lista de cursos
    }

}
