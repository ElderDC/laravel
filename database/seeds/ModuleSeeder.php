<?php

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'name'        => 'Modules',
            'description' => 'Modules',
            'environment' => 'admin'
        ]);

        Module::create([
            'name'        => 'Roles',
            'description' => 'Roles',
            'environment' => 'admin'
        ]);

        Module::create([
            'name'        => 'Users',
            'description' => 'Users',
            'environment' => 'admin'
        ]);
    }
}
