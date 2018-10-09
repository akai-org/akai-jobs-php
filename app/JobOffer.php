<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOffer extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }

    public function degree(){
        return $this->belongsTo('App\Degree');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function fill(array $attributes)
    {
        // TODO tworzenie nowego adresu lub przypisywanie do istniejącego, jeżeli taki juz istnieje
    }

    public static function create($attributes)
    {
        $jobOffer = new self();
        return $jobOffer->fill($attributes);
    }

}
