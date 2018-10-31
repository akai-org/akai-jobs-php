<?php

namespace App;

use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    /**
     * Funkcja sprawdza, czy podany adres juz istnieje. Jezeli tak, to zwraca jego ID, a jezeli nie to go tworzy i zwraca jego ID
     * @param array $data array zawierający dane adresowe: address, voivodeship, country, city, postal_code
     * @param User $target obiekt mający relację z adresem, który jest edytowany
     *
     * @return int ID wskazanego adresu
     */
    public static function createOrAssign(array $data, User $target = null){

        // Set the variables and throw an error if any variable remains empty.
        // If target is set, then data in data array can be fetch from this target, so you don't always have to specify full address in first argument
        if($target)
        {
            $address        = $data['address']      ?? $target->address->address;
            $country        = $data['country']      ?? $target->address->country;
            $city           = $data['city']         ?? $target->address->city;
            $postalCode     = $data['postal_code']  ?? $target->address->postal_code;
        } else {
            $address        = $data['address'];
            $country        = $data['country'];
            $postalCode     = $data['postal_code'];
            $city           = $data['city'];

        }
        if(!$address || !$country || !$postalCode || !$city)
            throw new InvalidArgumentException("Can't obtain full address. Make sure that object you're trying to edit is valid and that you supply correct values in request", 400);

        // Search for address identical as the one specified above and return its ID
        $addressObject = Address::where('address', $address)
            ->where('country', $country)
            ->where('postal_code', $postalCode)
            ->where('city', $city)->first();
        if($addressObject)
            return $addressObject->id;


        // Create new address if none was found above
        $addressObject = new self();
        $addressObject->country       = $country;
        $addressObject->city          = $city;
        $addressObject->address       = $address;
        $addressObject->postal_code   = $postalCode;
        $addressObject->save();

        return $addressObject->id;
    }
}
