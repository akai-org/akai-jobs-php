<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder;
use Sniffer\Sniffer;
use Illuminate\Http\Request;

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

    public function fillWithData(array $attributes)
    {
        // TODO tworzenie nowego adresu lub przypisywanie do istniejącego, jeżeli taki juz istnieje
    }

    public static function createWithData($attributes)
    {
        $jobOffer = new self();
        return $jobOffer->fill($attributes);
    }

    public static function applyFilters(Request $request)
    {
        $query = self::query();

        Sniffer::searchFilter($query, $request['keyword'], [
            'name',
            'description'
        ]);
        Sniffer::findGreater($query, [
            'salary' => $request['min_salary'],
            'start_date' => $request['min_start_date'],
            'end_date' => $request['min_end_date'],
        ]);
        Sniffer::findLesser($query, [
            'salary' => $request['max_salary'],
            'start_date' => $request['max_start_date'],
            'end_date' => $request['max_end_date'],
        ]);
        Sniffer::findMatchingValues($query, [
            'position_id' => $request['positions'],
            'degree_id' => $request['degrees'],
        ]);

        return $query;
    }
}
