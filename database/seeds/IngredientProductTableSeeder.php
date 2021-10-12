<?php

use Illuminate\Database\Seeder;
use App\ProductIngredient;

class IngredientProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(range(1,1000) as $index){
            DB::table('ingredient_product')->insert([
                'product_id' => rand(1,1000),
                'ingredient_id' => rand(1,1000)
            ]);
        }
        //factory(ProductIngredient::class, 50)->create();
    }
}
