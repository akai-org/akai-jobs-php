<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     *
     * @api             {get} /apiv1/users/logout Logout
     * @apiName         UserLogout
     * @apiDescription  Logout user.
     * @apiGroup        Users
     *
     * @apiExample  {js} Pseudocode example:
     * $http([
     *     method => "POST"
     *     url => "http://{base_url}/api/users/logout",
     *     headers => [
     *         Authorization => Bearer {TOKEN}
     *     ]
     * ]);
     *
     * @apiUse Authorization
     *
     * @apiSuccess {string} message Successful logout message
     */
    /**
     * Logs user out
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(){

        // If logged in
        if (Auth::check()) {

            // Delete token and return message
            Auth::user()->AauthAccessToken()->delete();
            return response([
                'message' => 'Wylogowano się pomyślnie'
            ]);
        }

        // Something got messy
        return false;
    }


    /**
     * @api {get} apiv1/users/:user_id My profile
     *
     * @apiName         ShowMeMyself
     * @apiDescription  Get current user details
     * @apiGroup        Users
     * @apiUse          Response
     * @apiUse          Authorization
     *
     * @apiSuccess {object}     data.user           Data about user
     */
    /**
     * Gets data for authenticated user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function showCurrentUser(){
        $user = Auth::user();

        return response([
            'message' => 'Pomyślnie pobrano aktualnie zalogowanego użytkownika',
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
