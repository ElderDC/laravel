<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'environment',
    ];

    /**
     * The options that are assignable to gender attribute.
     *
     * @var array
     */
    public static $ENVIRONMENTS = [
        'public',
        'admin',
    ];

    /**
     * Get all options environment.
     *
     * @return array
     */
    public static function getEnvironmentOptions()
    {
        return self::$ENVIRONMENTS;
    }

    /**
     * Get the environment by name.
     *
     * @return integer
     */
    public static function getEnvironmentByName($environment)
    {
        return array_search($environment, self::$ENVIRONMENTS) + 1;
    }

    /**
     * Get the environment by id.
     *
     * @return string
     */
    public static function getEnvironmentById($environment)
    {
        return self::$ENVIRONMENTS[$environment - 1];
    }

    /**
     * Get the module's environment.
     *
     * @param  string  $value
     * @return string
     */
    public function getEnvironmentAttribute($value)
    {
        return self::$ENVIRONMENTS[$value - 1];
    }

    /**
     * Set the module's environment.
     *
     * @param  string  $value
     * @return void
     */
    public function setEnvironmentAttribute($value)
    {
        $this->attributes['environment'] = array_search($value, self::$ENVIRONMENTS) + 1;
    }

    /**
     * Get the permissions records associated with the module.
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
