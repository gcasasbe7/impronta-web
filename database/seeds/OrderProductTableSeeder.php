<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,1000) as $index){
            DB::table('order_product')->insert([
                'order_id' => rand(1,1000),
                'product_id' => rand(1,1000)
            ]);
        }

        foreach(range(1,1000) as $index){
            DB::table('order_products')->insert([
                'order_id' => rand(1,1000),
                'product_id' => rand(1,1000),
                'product_name' => str_random(10),
                'quantity' => rand(1,5),
                'size' => str_random(7),
            ]);
        }
        //factory(OrderProduct::class, 60)->create();
    }
}
