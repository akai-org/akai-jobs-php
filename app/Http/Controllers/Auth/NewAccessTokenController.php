<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Zend\Diactoros\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Log;
use App\UserLogin;
use App\User;


class NewAccessTokenController extends AccessTokenController
{
    /**
     * Przesłonięcie funkcji - logi, modyfikacja i tłumaczenie odpowiedzi
     *
     * @param ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        // Pozyskiwanie odpowiedzi
        $response               = parent::issueToken($request);
        $parsedResponse         = json_decode($response->content());
        $requestedUserEmail     = null;
        if (isset($request->getParsedBody()['username']))
            $requestedUserEmail = $request->getParsedBody()['username'];
        $requestedUser          = User::where('email', $requestedUserEmail)->first();

        // Jeżeli próba się nie udała
        if(isset($parsedResponse->error)){

            // Dodaj log systemowy
            Log::notice('Nieudana próba logowania', [
                'ip'     => $_SERVER['REMOTE_ADDR'],
                'error'  => $parsedResponse->message,
                'user'   => (isset($requestedUser))? $requestedUser->email: null
            ]);

            //Przetłumacz odpowiedź
            $parsedResponse->message = __($parsedResponse->message);
            $parsedResponse->error = __($parsedResponse->error);
            $response->setContent(json_encode($parsedResponse));
        }

        // Jeżeli próba jednak się udała
        else if (isset($parsedResponse->token_type)){

            // Dodaj ID usera do odpowiedzi API
            $parsedResponse->user_object = $requestedUser;
            $response->setContent(json_encode($parsedResponse));
        }
        return $response;
    }
}

