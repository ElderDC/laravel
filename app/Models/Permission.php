<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'module_id',
        'action',
        'scope',
        'slug',
    ];

    /**
     * The options that are assignable to action attribute
     *
     * @var array
     */
    public static $ACTIONS = [
        'view',
        'edit',
        'create',
        'delete',
        'publish',
        'import',
        'export',
    ];

    /**
     * The options that are assignable to scope attribute
     *
     * @var array
     */
    public static $SCOPES = [
        'own',
        'any',
    ];

    /**
     * Get all options action.
     *
     * @return array
     */
    public static function getActionOptions()
    {
        return self::$ACTIONS;
    }

    /**
     * Get the action by name.
     *
     * @param  string  $action
     * @return integer
     */
    public static function getActionByName($action)
    {
        return array_search($action, self::$ACTIONS) + 1;
    }

    /**
     * Get the action by id.
     *
     * @param  integer  $action
     * @return string
     */
    public static function getActionById($action)
    {
        return self::$ACTIONS[$action - 1];
    }

    /**
     * Get the permission's action.
     *
     * @param  string  $value
     * @return string
     */
    public function getActionAttribute($value)
    {
        return self::$ACTIONS[$value - 1];
    }

    /**
     * Set the permission's action.
     *
     * @param  string  $value
     * @return void
     */
    public function setActionAttribute($value)
    {
        $this->attributes['action'] = array_search($value, self::$ACTIONS) + 1;
    }

    /**
     * Get all options scope.
     *
     * @return array
     */
    public static function getScopeOptions()
    {
        return self::$SCOPES;
    }

    /**
     * Get the scope by name.
     *
     * @param  string  $scope
     * @return integer
     */
    public static function getScopeByName($scope)
    {
        return array_search($scope, self::$SCOPES) + 1;
    }

    /**
     * Get the scope by id.
     *
     * @param  integer  $scope
     * @return string
     */
    public static function getScopeById($scope)
    {
        return self::$SCOPES[$scope - 1];
    }

    /**
     * Get the permission's action.
     *
     * @param  string  $value
     * @return string
     */
    public function getScopeAttribute($value)
    {
        return self::$SCOPES[$value - 1];
    }

    /**
     * Set the permission's scope.
     *
     * @param  string  $value
     * @return void
     */
    public function setScopeAttribute($value)
    {
        $this->attributes['scope'] = array_search($value, self::$SCOPES) + 1;
    }

    /**
     * Get the permission's module name.
     *
     * @return string
     */
    public function getModuleNameAttribute()
    {
        return $this->attributes['module_name'] = $this->module->name;
    }

    /**
    * Get the role record associated with the permission.
    *
    * @return object
    */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
    * Get the module record associated with the permission.
    *
    * @return object
    */
    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }
}
