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

}
