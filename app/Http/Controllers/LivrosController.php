<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Livro;
use Auth;

class LivrosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::paginate(3);
        return view('arquivadas', compact('livros'));
    }
    public function arquivada()
    {
        $livros = Livro::paginate(3);
        return view('arquivadas', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

               /*Validando os dados*/
		$validar 			= 	$request->validate([
			'nome' 			=> 'required | max:30',
			'autor' 	    => 'required | max:30',
		],[
			'nome.required' => 'Preencha o nome da Livro',
			'nome.max' => 'Digite no máximo 30 caracteres neste campo',

            'autor.required' => 'Preencha o autor do Livro',
			'autor.max' => 'Digite no máximo 30 caracteres neste campo',
		]);

		/*Atualizando todos esses itens da model*/
		$livros	= new Livro;
		$livros->nome = $request->nome;
		$livros->autor = $request->autor;
		$livros->user_id = Auth::id();
		$livros->save();

        $message = 'Livro cadastrada com Sucesso!';

		return redirect('/dashboard')->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $livros = Livro::where('id',$id)->first();
     return view('dashboard', compact("livros"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livro = Livro::where('id',$id)->first();
        $livro->nome = $request->nome;
		$livro->autor = $request->autor;
        $livro->save();

        return redirect()->route('livros.arquivada');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = livro::where('id',$id)->delete();
		return redirect()->route('livros.arquivada');
    }
}
