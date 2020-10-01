<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar') }}
        </h2>
    </x-slot>
    <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

            <h1 style="width: 100%;color: #808080; ">
            @isset($livros)
               EDITAR LIVROS
            @else
                CADASTRAR LIVROS
            @endif
            </h1>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
    @isset($livros)
        <form method="Post" action="{{ route('livros.update', $livros->id) }}">
        @method('PUT')
    @else
        <form method="POST" action="{{ route('livros.store') }}">
     @endif
            @csrf
            <div>
                <x-jet-label value="{{ __('Nome do livro') }}" />
                <x-jet-input class="block mt-1 w-full" type="nome" name="nome" :value="old('nome')" value="{{$livros->nome ?? ''}}" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Autor do livro') }}" />
                <x-jet-input class="block mt-1 w-full" type="autor" name="autor" value="{{$livros->autor ?? ''}}" required autofocus />
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="ml-4">
                   @isset($livros)
                   {{ __('salvar') }}
                   @else
                    {{ __('cadastrar') }}
                    @endif
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

</x-app-layout>
