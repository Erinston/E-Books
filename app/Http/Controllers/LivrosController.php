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
			'nome' 			=> 'required | max:30 | string | different:field',
			'autor' 	    => 'required | max:30',
			'paginas' 		=> 'required | max:30 |' ,
			'genero' 	    => 'required | ',
			'data' 	        => 'required | date',
			'idioma' 		=> 'required | max:30',
			'editora' 	    => 'required | max:30',
			'online' 	    => 'required | ',
		],[
			'nome.required' => 'Preencha o nome da Livro',
            'nome.max' => 'Digite no máximo 30 caracteres neste campo',
            'nome.min' => 'No minimo 1 uma letra',

            'autor.required' => 'Preencha o autor do Livro',
            'autor.max' => 'Digite no máximo 30 caracteres neste campo',

            'paginas.required' => 'Preencha o a quantidade de paginas do Livro',
			'paginas.max' => 'Digite no máximo 30 caracteres neste campo',
            'paginas.numeric' => 'Digite apenas numeros no campo Nº PAGINAS',

            'genero.required' => 'Preencha o genero do Livro',
            'genero.max' => 'Digite no máximo 30 caracteres neste campo',

            'data.required' => 'Preencha o data de edição do Livro',

            'idioma.riquered' => 'Preencha o idioma do livro',
            'idioma.max' => 'Digite no máximo 30 caracteres neste campo',

            'editora.riquered' => 'Preencha o idioma do livro',
            'editora.max' => 'Digite no máximo 30 caracteres neste campo',


		]);

		/*Atualizando todos esses itens da model*/
		$livros	= new Livro;
        $this->save($livros,$request);

                $message = 'Livro cadastrada com Sucesso!';
                return redirect('/dashboard')->with('success',$message);

    }
    private function save($livros, Request $request){

        $livros->nome = $request->nome;
		$livros->autor = $request->autor;
		$livros->paginas = $request->paginas;
		$livros->genero = $request->genero;
		$livros->data = $request->data;
		$livros->idioma = $request->idioma;
		$livros->editora = $request->editora;
		$livros->online = $request->online;
		$livros->user_id = Auth::id();
        $livros->save();

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

        $this->save($livro,$request);
        $message = 'Livro Editado com Sucesso!';
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
