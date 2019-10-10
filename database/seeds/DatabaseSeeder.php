<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Invocando clases seeder para llenar un rol y permisos
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);

        // Obiteniendo rol
        $role = App\Role::first();
        // Obteniendo permisos
        $permisions = App\Permission::all();
        // Vinculando rol con permisos
        $role->permissions()->sync($permisions);


        // Invocando facotires para llenar user
        factory(App\User::class, 1)->create();
        // Invocando facotires para llenar marcas
        factory(App\Brand::class, 3)->create();

    }
}
