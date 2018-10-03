<?php
namespace App\Http\Requests;
use Illuminate\Http\Request;


/**
 * Class exists in order to return JSON errors through API
 * because we couldn't get it to work otherwise.
 *
 * Additionally - changed $request in index.php to point
 * at this class
 *
 * @package App\Http\Requests
 */
class BaseRequest extends Request
{
    public function expectsJson()
    {
        if($this->segment(1) == 'api')
            return true;
        else
            return parent::expectsJson();

    }
    public function wantsJson()
    {
        if($this->segment(1) == 'api')
            return true;
        else
            return parent::wantsJson();

    }
}