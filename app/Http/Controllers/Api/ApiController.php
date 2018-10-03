<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @apiDefine Authorization
 * @apiHeader {string} Authorization    Auth Token
 */
/**
 * @apiDefine AuthorizationOptional
 * @apiHeader {string} [Authorization]    Auth Token
 */
/**
 * @apiDefine Response
 * @apiSuccess {string} message   Success message
 * @apiSuccess {array} data      Data array
 *
 * @apiError {string} message       Error message
 * @apiError {object} [errors]      Errors object
 * @apiError {string} [exception]   Exception
 * @apiError {string} [file]        Error file
 * @apiError {int}    [line]        Error line
 * @apiError {array}  [trace]       Error trace
 */

/**
 * @apiDefine ResponseErrors
 *
 * @apiError {string} message       Error message
 * @apiError {object} [errors]      Errors object
 * @apiError {string} [exception]   Exception - only in debug mode
 * @apiError {string} [file]        Error file - only in debug mode
 * @apiError {int}    [line]        Error line - only in debug mode
 * @apiError {array}  [trace]       Error trace - only in debug mode
 */

/**
 * @api {post} api/oauth/token Login
 *
 * @apiName         Login
 * @apiDescription  Tries to log user in. For client data go to: Clients
 * @apiGroup        Users
 *
 * @apiParam        (POST Param) client_id      Passport generated client's ID
 * @apiParam        (POST Param) client_secret  Passport generated client's secret
 * @apiParam        (POST Param) username       user's mail
 * @apiParam        (POST Param) password       user's password
 * @apiParam        (POST Param) grant_type     Grant access type, type: "password"
 *
 * @apiSuccess      {string} token_type     Token type
 * @apiSuccess      {int}    expires_in     Time to token expiration (seconds)
 * @apiSuccess      {string} access_token   Access Token
 * @apiSuccess      {string} refresh_token  Refresh token
 * @apiError        {string} error          Error
 * @apiError        {string} message        Rrror details
 * @apiExample  {js} Pseudocode example:
 * $http([
 *     method => "POST"
 *     url => "http://{base_url}/api/oauth/token",
 *     data => [
 *          "client_id" => 2,
 *          "username" => "test@testownia.pl",
 *          "password" => "test123",
 *          "grant_type" => "password",
 *          "client_secret" => "abcdefghijkl"
 *     ]
 * ]);
 *
 * @apiParam (Url Params) {int} :user_id    Requested user's ID
 *
 * @apiSuccess {object}     data.user       Data about user
 */
class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
