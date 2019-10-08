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
        factory(App\Role::class, 1)->create();
        factory(App\User::class, 1)->create();

        // $this->call(RoleTableSeeder::class);
        // $this->call(UserTableSeeder::class);
    }
}
