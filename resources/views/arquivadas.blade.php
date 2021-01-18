<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('LISTAR LIVROS') }}
        </h2>
    </x-slot>
    <center>
   <table style="width: 70%; background:white; border: 2px solid  #808080; ">
    <th style="background:black; color: white;text-align: center;  ">Nome do livro</th>
    <th style="background:black; color: white;text-align: center; "> Autor do livro </th>
    <th style="background:black; color: white;text-align: center; "> Editar  </th>
    <th  style="background:black; color: white;text-align: center;  "> Delete  </th>
       @foreach($livros as $l)

    <tr>
        <td style="color: rgb(0, 0, 0); text-align: center; border:2px solid #808080;">{{$l->nome}}</td>
        <td style="color: black; text-align: center; border:2px solid #808080;">{{$l->autor}}</td>
        <td style="background:rgb(128, 179, 128);  border:2px solid #808080;text-align: center;"> <a style="background:green; color: white; " href="{{route('livros.edit', $l->id)}}">Editar</a></td>



        <form action="{{route('livros.destroy', $l->id)}}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
                <td style="background:red; border:2px solid #808080; text-align: center" type="" >
                   <button style="background:red; color: white;  "type="submit">
                       Delete
                   </button>
                </td>

        </form>
   </tr>
        @endforeach
   </table>




   </table>
   {{ $livros->links() }}
    </center>


</x-app-layout>
