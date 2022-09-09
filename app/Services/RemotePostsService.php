<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class RemotePostsService {

    protected $http_client = null;

    public function __construct()
    {
        $this->http_client = Http::withOptions( [
            'verify' => false
        ] );
    }

    public function getPosts( $amount )
    {
        $response = $this->http_client->get( 'https://jsonplaceholder.typicode.com/posts' );

        // Simplificado para la ocasión
        if ( $response->failed() ) return [];

        $posts = json_decode( $response->getBody()->getContents(), true );

        $cont = 0;
        $amount_posts = [];

        foreach ( $posts as $post ) {

            if ( $cont == 50 ) break;

            $amount_posts[] = $post;
            $cont++;

        }

        return $amount_posts;
    }
}