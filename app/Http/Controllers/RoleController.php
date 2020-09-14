<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use App\Http\Resources\RoleResource;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return RoleResource::collection(Role::with('permissions')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->only([
            'name',
            'description',
            'environment',
        ]));

        $modules = (Module::all())->toArray();

        $permissions = $request->permissions;
        foreach ($permissions as $index => $permission) {
            $module = $modules[array_search($permission['module_id'], array_column($modules, 'id'))];
            $permissions[$index]['slug'] = Str::slug($module['name'] . '-' . $permission['action'] . '-' . $permission['scope'], '-');
        }

        $role->permissions()->createMany($permissions);
        $role->load('permissions');

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->only([
            'name',
            'description',
            'environment',
        ]));
        $role->permissions()->delete();

        $modules = (Module::all())->toArray();

        $permissions = $request->permissions;
        foreach ($permissions as $index => $permission) {
            $module = $modules[array_search($permission['module_id'], array_column($modules, 'id'))];
            $permissions[$index]['slug'] = Str::slug($module['name'] . '-' . $permission['action'] . '-' . $permission['scope'], '-');
        }

        $role->permissions()->createMany($permissions);
        $role->load('permissions');

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete();
        $role->delete();
        return response()->json(null,204);
    }
}
