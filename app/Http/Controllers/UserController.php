<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
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

    // API ////////////////////////////////////////////////
    public function apiIndex()
    {
        $responseData = [
            'message'   => 'ok',
            'data'      => []
        ];

        $users = DB::select(
            'SELECT U.name,
                    U.email,
                    U.city,
                    P.user_id,
                    P.id as post_id,
                    P.title as post_title,
                    P.body as post_body,
                    M.media
            FROM users AS U
            LEFT JOIN posts AS P ON ( P.user_id = U.id )
            LEFT JOIN ( SELECT P.user_id, AVG( P.rating ) AS media
                        FROM posts AS P
                        GROUP BY 1 ) AS M ON ( M.user_id = U.id )'
        );

        foreach ( $users as $user ) {

            if ( ! isset( $responseData[ 'data' ][ $user->user_id ] ) ) {

                $responseData[ 'data' ][ $user->user_id ] = [
                    'id'        => $user->user_id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'city'      => $user->city,
                    'media'     => $user->media,
                    'posts'     => []
                ];

            }

            $responseData[ 'data' ][ $user->user_id ][ 'posts' ][] = [
                'id'        => $user->post_id,
                'user_id'   => $user->user_id,
                'title'     => $user->post_title,
                'body'      => $user->post_body
            ];

        }

        $collection = collect( $responseData[ 'data' ] );

        $sorted = $collection->sortBy( 'media' );

        $responseData[ 'data' ] = $sorted->values()->all();

        return response()->json( $responseData );

    }
}
