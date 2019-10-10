<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('permissions')->insert([
            ['name' => 'Modulo categorìas', 'slug' => 'manage_categories'],
            ['name' => 'Modulo mercados', 'slug' => 'manage_markets'],
            ['name' => 'Modulo marcas', 'slug' => 'manage_brands'],
            ['name' => 'Modulo productos', 'slug' => 'manage_products'],
            ['name' => 'Modulo posts', 'slug' => 'manage_posts'],
            ['name' => 'Modulo administrador', 'slug' => 'manage_admin'],
        ]);


    }
}
