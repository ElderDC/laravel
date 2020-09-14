<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
    ];

    /**
     * The options that are assignable to gender attribute.
     *
     * @var array
     */
    public static $GENDERS = [
        'male',
        'female',
    ];

    /**
     * Get the person's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's gender.
     *
     * @param  string  $value
     * @return string
     */
    public function getGenderAttribute($value)
    {
        return self::$GENDERS[$value - 1];
    }

    /**
     * Set the user's gender.
     *
     * @param  string  $value
     * @return void
     */
    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = array_search($value, self::$GENDERS) + 1;
    }

    /**
    * Get the user record associated with the person.
    *
    * @return object
    */
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
