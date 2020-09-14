<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Role extends Model
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
    static function getEnvironmentOptions()
    {
        return self::$ENVIRONMENTS;
    }

    /**
     * Get the environment by name.
     *
     * @param  string  $environment
     * @return integer
     */
    static function getEnvironmentByName($environment)
    {
        return array_search($environment, self::$ENVIRONMENTS) + 1;
    }

    /**
     * Get the environment by id.
     *
     * @param  integer  $environment
     * @return string
     */
    static function getEnvironmentById($environment)
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
     * Get the module's permissions.
     *
     * @return array
     */
    public function getPermissionSlugsAttribute()
    {
        return Arr::pluck($this->permissions->toArray(), 'slug');
    }

    /**
     * Get the users records associated with the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get the permissions records associated with the role.
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
