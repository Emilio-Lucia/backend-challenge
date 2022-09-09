<x-layout body_class="home">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Obteniendo posts
        </h2>
    </x-slot>

    <x-layouts.content-short>

        <div id="v_app" class="v-app">

            <div>
                Se guardaron {{ $postCont }} posts en la BD.
            </div>

            <div>
                Se guardaron {{ $usersCont }} usuarios en la BD.
            </div>

            @if ( ! true )
                <ul>
                    @foreach ( $posts as $post )
                    <li>{{ var_dump( $post ) }}</li>
                    @endforeach
                </ul>
            @endif

            @if ( ! true )
                <ul>
                    @foreach ( $users as $user )
                    <li>{{ var_dump( $user ) }}</li>
                    @endforeach
                </ul>
            @endif

        </div>

    </x-layouts.content-short>
    
</x-layout>