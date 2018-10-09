<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    // TODO funkcja sprawdzająca, czy adres o podanych danych już istnieje i tworząca nowy, jeżeli nie istnieje
}
