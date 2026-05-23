<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;

class AlunoController extends Controller
{

    public function index(){
        $rows = Aluno::all();
        return view('admin.alunos.index', compact('rows'));
    }

    public function adicionar() {
        $cursos = Curso::all();
        return view('admin.alunos.adicionar', compact('cursos'));
    }

    public function editar($id) {
        $linha = Aluno::find($id);
        $cursos = Curso::all();
        return view('admin.alunos.editar', compact('linha', 'cursos'));
        // manda o registro encontrado para ser editado na visão
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();
        if($req->hasFile('arquivo')){
            $imagem = $req->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/alunos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir."/".$nomeImagem;
        }
        Aluno::create($dados);
        return redirect()->route('admin.alunos');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();
        if($req->hasFile('arquivo')){ // o upload chegou ?
            $imagem = $req->file('arquivo'); // pega arquivo de imagem
            $num = rand(1111,9999); // escolhe numero pra não repetir
            $dir = "img/alunos/"; // pasta de imagens
            $ex = $imagem->guessClientExtension(); // pega extensão, jpg, png ...
            $nomeImagem = "imagem_".$num.".".$ex; // monta novo nome
            $imagem->move($dir, $nomeImagem); // move pro lugar correto e novo nome
            $dados['imagem'] = $dir."/".$nomeImagem; // salva no campo imagem
        }
        Aluno::find($id)->update($dados);
        return redirect()->route('admin.alunos');
    }

    public function excluir($id) {
        Aluno::find($id)->delete();
        // apos selecionar o registro, é chamado o
        // método DELETE do OBJETO registro
        return redirect()->route('admin.alunos');
        // abre a visão da lista de alunos
    }

}
