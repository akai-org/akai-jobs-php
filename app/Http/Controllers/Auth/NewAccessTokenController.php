<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Zend\Diactoros\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Log;
use App\User;


class NewAccessTokenController extends AccessTokenController
{
    /**
     * Method shadowing for enabling translation
     *
     * @param ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        // Getting API response
        $response               = parent::issueToken($request);
        $parsedResponse         = json_decode($response->content());
        $requestedUserEmail     = $request->getParsedBody()['username'];
        $requestedUser          = User::where('email', $requestedUserEmail)->first();

        // If failure
        if(isset($parsedResponse->error)){

            // Add system log
            Log::notice('Nieudana próba logowania', [
                'ip'     => $_SERVER['REMOTE_ADDR'],
                'error'  => $parsedResponse->message,
                'user'   => ($requestedUser)? $requestedUser->email: null
            ]);

            // Translate response
            $parsedResponse->message = __($parsedResponse->message);
            $parsedResponse->error = __($parsedResponse->error);
            $response->setContent(json_encode($parsedResponse));
        }

        // If success
        else if (isset($parsedResponse->token_type)){

            // Add info about user to API response
            $parsedResponse->user_object = $requestedUser;
            $response->setContent(json_encode($parsedResponse));

            // Log successfull login attemp
//            $requestedUser->logLogin();

        }
        return $response;
    }
}

