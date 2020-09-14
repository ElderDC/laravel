<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Http\Resources\ModuleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ModuleResource::collection(Module::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'description' => 'required|string',
            'environment' => 'required|in:' . implode(",", Module::getEnvironmentOptions()),
        ]);

        $module = Module::create($request->only([
            'name',
            'description',
            'environment',
        ]));

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'description' => 'required|string',
            'environment' => 'required|in:' . implode(",", Module::getEnvironmentOptions()),
        ]);

        $module->update($request->only([
            'name',
            'description',
            'environment',
        ]));

        $permissions = $module->permissions()->get();

        foreach ($permissions as $permission) {
            $permission->slug = Str::slug($module->name . '-' . $permission->action . '-' . $permission->scope, '-');
        }

        $module->permissions()->saveMany($permissions);

        return new ModuleResource($module);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Module $module)
    {
        $module->permissions()->delete();
        $module->delete();
        return response()->json(null,204);
    }
}
