<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'categories_id' => 1,
                'name' => 'Rak Alfamart',
                'slug' => 'rak-alfamart',
                'type' => 'Rak Besar',
                'tags' => 'rak',
                'sku' => 'rak123912',
                'weight' => '35',
                'description' => '<p>rak anjai</p>',
                'price' => 1000000,
                'quantity' => 10,
                'deleted_at' => NULL,
                'created_at' => '2022-05-28 05:39:59',
                'updated_at' => '2022-05-28 05:39:59',
            ),
            1 => 
            array (
                'id' => 2,
                'categories_id' => 1,
                'name' => 'Rak Indomaret',
                'slug' => 'rak-indomaret',
                'type' => 'rak',
                'tags' => 'rak',
                'sku' => 'rakindo',
                'weight' => '10',
                'description' => '<p>rak</p>',
                'price' => 90000000,
                'quantity' => 10,
                'deleted_at' => NULL,
                'created_at' => '2022-06-15 01:27:24',
                'updated_at' => '2022-06-15 01:27:24',
            ),
        ));
        
        
    }
}