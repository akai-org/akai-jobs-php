<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetToken extends Controller
{


    /**
     *
     * @api             {get} /apiv1/oauth/getclients ApiClients
     * @apiName         PasswordClients
     * @apiDescription  Returns client list and their data to be used in authenthication
     * @apiGroup        Users
     *
     * @apiExample  {js} Pseudocode example:
     * $http([
     *     method => "GET",
     *     url => "http://{base_url}/api/oauth/getclients"
     * ]);
     *
     * @apiUse Response
     * @apiSuccess {array} [data.clients]  Client list
     */
    public function __invoke()
    {
        $clients = DB::table('oauth_clients')->get(['id', 'secret']);

        return response([
            'message' => 'Pomyślnie pobrano aktualnych klientów passworda',
            'data' => [
                'clients' => $clients
            ]
        ]);
    }
}
