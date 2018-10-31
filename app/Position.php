<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function fillWithData(String $name)
    {
        $this->name = $name;
        $this->save();
        return $this;
    }

    public static function createWithData(String $name)
    {
        $position = new self();
        return $position->fillWithData($name);
    }

    /**
     * Return ID of existing record with given name or create new record with that name
     * @param String $name
     * @return mixed
     */
    public static function createOrAssign(String $name)
    {
        // If position with given name already exists then return its ID
        $position = Position::where('name', $name)->first();
        if($position)
            return $position->id;

        // If it doesn't then create on with given name and return its ID
        $position = self::createWithData($name);
        return $position->id;
    }
}
