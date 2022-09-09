<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RemotePostsService;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\User;

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


        $postCont   = 0;
        $editors    = [];

        // Guardamos los posts en BD
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

            ! in_array( $post->user_id, $editors ) && ( $editors[] = (int) $post->user_id );

            $success = $post->save();

            $success && ( $postCont++ );

        }


        $usersCont      = 0;
        $remote_users   = $rpService->getUsers();

        // Guardamos los usuarios en BD
        foreach ( $editors as $editorId ) {

            $user = User::find( $editorId );

            if ( ! empty( $user ) ) continue;

            $editor = call_user_func( function( $editorId ) use( $remote_users ) {

                foreach( $remote_users as $remote_user ) {

                    if ( $remote_user[ 'id' ] == $editorId ) return $remote_user;

                }

                return null;

            }, $editorId );

            if ( empty( $editor ) ) continue;

            $user = User::create( [
                'id'        => $editor[ 'id' ],
                'name'      => $editor[ 'name' ],
                'email'     => $editor[ 'email' ],
                'city'      => $editor[ 'address' ][ 'city' ]
            ] );

            $success = $user->save();

            $success && ( $usersCont++ );

        }

        return View::make( 'getposts', [
            // 'posts'         => $remote_posts,
            'postCont'      => $postCont,
            // 'users'         => $rpService->getUsers(),
            // 'editors'       => $editors,
            'usersCont'     => $usersCont
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
