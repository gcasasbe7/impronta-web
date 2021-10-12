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
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);

        $this->call(CommentsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(VouchersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(BooksTableSeeder::class);

        $this->call(IngredientProductTableSeeder::class);
        $this->call(OrderProductTableSeeder::class);
    }
}
