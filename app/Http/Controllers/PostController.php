<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RemotePostsService;
use Illuminate\Support\Facades\View;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request, $amount = 50, RemotePostsService $rpService )
    {
        $remote_posts = $rpService->getPosts( $amount );


        $cont = 0;

        foreach ( $remote_posts as $remote_post ) {

            $post = Post::find( $remote_post[ 'id' ] );

            if ( empty( $post ) ) {

                $post           = Post::create( [
                    'id'        => $remote_post[ 'id' ],
                    'user_id'   => $remote_post[ 'userId' ],
                    'title'     => $remote_post[ 'title' ],
                    'body'      => $remote_post[ 'body' ],
                    'rating'    => \call_user_func( function( $remote_post ) {

                        $rating = str_word_count( $remote_post[ 'title' ] ) * 2;
                        $rating += str_word_count( $remote_post[ 'body' ] );

                        return $rating;

                    }, $remote_post )
                ] );

            }
            else {

                $post->body = $remote_post[ 'body' ];

            }

            $success = $post->save();

            $success && ( $cont++ );

        }

        return View::make( 'getposts', [

            // 'posts'     => $remote_posts
            'cont'  => $cont

        ] );

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
