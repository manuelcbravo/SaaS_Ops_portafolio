<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Usiario prueba',
                'email' => 'prueba@portafolio.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$HPntyci5GXrmMgjtR8aLG.HRP0zp4mpMlpTkhdm4Gw4atAwZo2nOS',
                'remember_token' => NULL,
                'created_at' => '2026-01-14 21:21:43',
                'updated_at' => '2026-01-14 21:21:43',
                'is_super_admin' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'manuel ',
                'email' => 'admin@laravelconmanuel.dev',
                'email_verified_at' => NULL,
                'password' => '$2y$12$Rz3BfJAxOH8pmaJJfPZYFOs7.Y9zHOL9IbCtyX3vheVfxgabQKL8a',
                'remember_token' => NULL,
                'created_at' => '2026-01-16 18:09:11',
                'updated_at' => '2026-01-16 18:09:11',
                'is_super_admin' => true,
            ),
        ));
        
        
    }
}