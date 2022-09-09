<x-layout body_class="home">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Obteniendo posts
        </h2>
    </x-slot>

    <x-layouts.content-short>

        <div id="v_app" class="v-app">

            <div>
                Se guardaron {{ $cont }} posts en la BD.
            </div>

            @if ( false )
                <ul>
                    @foreach ( $posts as $post )
                    <li>{{ var_dump( $post ) }}</li>
                    @endforeach
                </ul>
            @endif

        </div>

    </x-layouts.content-short>
    
</x-layout>