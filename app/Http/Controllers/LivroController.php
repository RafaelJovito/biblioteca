<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        // direciona para a view e fornece um vetor
        // contendo os livros
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        // valida o formulário
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'paginas' => 'required']);
       
        // obtém os valores do form
        Livro::create($request->all());
            
        // direciona para página cadastro novamente,
        // com uma mensagem de sucesso
        return redirect()->route('livros.create')
            ->with('mensagem', 'Livro salvo com sucesso.');
    }

    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        // vamos validar os dados vindo do formulário
    $request->validate([
        'titulo' => 'required',
        'autor' => 'required',
        'paginas' => 'required']);
       
      // vamos atualizar o livro na tabela do banco de dados
      $livro->update($request->all());
       
      // agora vamos voltar para a listagem de livros
      return redirect()->route('livros.index')
        ->with('mensagem', 'Livro atualizado com sucesso.');
    }

    public function destroy(Livro $livro)
    {
         // vamos chamar o método delete() do Eloquent
    $livro->delete();
     
    // vamos chamar a view com uma mensagem de
    // de sucesso.
    return redirect()->route('livros.index')
      ->with('mensagem','Livro excluído com sucesso.');
    }
}
