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
                'first_name' => 'admin',
                'last_name' => 'wijirak',
                'username' => NULL,
                'email' => 'admin@wijirak.com',
                'penerima' => 'john',
                'phone' => '0812312312',
                'province' => 'diy',
                'city' => 'sleman',
                'address' => 'sleman',
                'shipping_notes' => 'rak',
                'postcode' => '5512312',
                'email_verified_at' => NULL,
                'password' => '$2y$10$4sn7.57Y.wwV6j5WNNrrYuxIePw1/NsmgmYIX65sqiGvM2cY8DTVu',
                'remember_token' => NULL,
                'created_at' => '2022-05-28 05:36:39',
                'updated_at' => '2022-06-15 01:29:09',
                'roles' => 'ADMIN',
            ),
        ));
        
        
    }
}