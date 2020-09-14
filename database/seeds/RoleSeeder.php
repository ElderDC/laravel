<?php

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create([
            'name'        => 'Administrator',
            'description' => 'Administrator',
            'environment' => 'admin',
        ]);

        $actions = Permission::getActionOptions();

        $modules = (Module::where('environment', Module::getEnvironmentByName('admin'))->get())->toArray();

        $scope = 'any';
        $permissions = [];

        foreach ($modules as $index => $module) {
            foreach ($actions as $action) {
                $permissions[] = [
                    'module_id' => $module['id'],
                    'action'    => $action,
                    'scope'     => $scope,
                    'slug'      => Str::slug($module['name'], '-') . '-' . $action . '-' . $scope,
                ];
            }
        }

        $administrator->permissions()->createMany($permissions);
    }
}
