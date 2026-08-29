<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\AlunoController;
use App\Http\Controllers\Auth\GoogleController;

// Rota Principal
Route::get('/', function () {
    return view('welcome');
});

// Rota de Login (aponta para resources/views/auth/login.blade.php)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Rotas de Cursos (Admin)
Route::get('/admin/cursos', [CursoController::class, 'index'])->name('admin.cursos');
Route::get('/admin/cursos/adicionar', [CursoController::class, 'adicionar'])->name('admin.cursos.adicionar');
Route::post('/admin/cursos/salvar', [CursoController::class, 'salvar'])->name('admin.cursos.salvar');
Route::get('/admin/cursos/editar/{id}', [CursoController::class, 'editar'])->name('admin.cursos.editar');
Route::put('/admin/cursos/atualizar/{id}', [CursoController::class, 'atualizar'])->name('admin.cursos.atualizar');
Route::get('/admin/cursos/excluir/{id}', [CursoController::class, 'excluir'])->name('admin.cursos.excluir');

// Rotas de Alunos (Admin)
Route::get('/admin/alunos', [AlunoController::class, 'index'])->name('admin.alunos');
Route::get('/admin/alunos/adicionar', [AlunoController::class, 'adicionar'])->name('admin.alunos.adicionar');
Route::post('/admin/alunos/salvar', [AlunoController::class, 'salvar'])->name('admin.alunos.salvar');
Route::get('/admin/alunos/editar/{id}', [AlunoController::class, 'editar'])->name('admin.alunos.editar');
Route::put('/admin/alunos/atualizar/{id}', [AlunoController::class, 'atualizar'])->name('admin.alunos.atualizar');
Route::get('/admin/alunos/excluir/{id}', [AlunoController::class, 'excluir'])->name('admin.alunos.excluir');

// Rotas de Autenticação com o Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);