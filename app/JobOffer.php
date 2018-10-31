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
        $this->name = $attributes['name'];
        $this->description = $attributes['description'];
        $this->salary = $attributes['salary'];
        $this->start_date = $attributes['start_date'];
        $this->end_date = $attributes['end_date'];
        $this->area_id = $attributes['area_id'];
        $this->position_id = $attributes['position_id'];
        $this->degree_id = $attributes['degree_id'];
        $this->address_id = $attributes['address_id'];
        $this->company_id = $attributes['company_id'];
        $this->save();
        return $this;
    }

    public static function createWithData($attributes)
    {
        $jobOffer = new self();
        return $jobOffer->fillWithData($attributes);
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
