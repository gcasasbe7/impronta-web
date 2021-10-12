<?php

use Faker\Generator as Faker;


$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'surnames' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'direction' => $faker->streetAddress,
        'isAdmin' => $faker->boolean,
        'points' => $faker->numberBetween(1,1000),
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'likes' => $faker->numberBetween(0,638),
        'description' => $faker->text(50),
        'isExhausted' => $faker->boolean,
        'type' => $faker->numberBetween(1,5),
        'user_id' => 1,
        'isPublic' => 1,
        'price' => $faker->randomFloat(2,3.50, 99.99),
        'price_s' => $faker->randomFloat(2,3.50, 99.99),
        'price_m' => $faker->randomFloat(2,3.50, 99.99),
        'price_l' => $faker->randomFloat(2,3.50, 99.99),
        'price_b' => $faker->randomFloat(2,3.50, 99.99),
    ];
});

$factory->define(App\Ingredient::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'price' => $faker->randomFloat(2,0.25, 1.00),
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {

    return [
        'user_id' => random_int(1,50),
        'product_id' => random_int(1,50),
        'user_name' => $faker->name(),
        'user_photo' => 'http://simpleicon.com/wp-content/uploads/user-4.png',
        'comment' => $faker->text(120)
    ];
});

$factory->define(App\Event::class, function (Faker $faker) {

    return [
        'title' => $faker->name(),
        'description' => $faker->text(50),
        'photo' => 'http://simpleicon.com/wp-content/uploads/user-4.png',
        'start_date' => $faker->dateTime(),
        'end_date' => $faker->dateTime(),
    ];
});

$factory->define(App\Voucher::class, function (Faker $faker) {

    return [
        'code' => str_random(6),
        'points' => random_int(1,300),
        'dead_date' => $faker->dateTime(),
        'is_used' => $faker->boolean(),
        'user_id' => random_int(1,50)
    ];
});

$factory->define(App\Order::class, function (Faker $faker) {

    return [
        'reward_points' => $faker->randomFloat(2,1,200),
        'state' => 'Enviado',
        'orderDate' => $faker->dateTime(),
        'total_price' => $faker->randomFloat(2,20,200),
        'user_id' => random_int(1,50),
        'direction' => $faker->streetAddress,
        'is_payed' => $faker->boolean(),
    ];
});

$factory->define(App\Book::class, function (Faker $faker) {

    return [
        'user_id' => random_int(1,50),
        'numPeople' => random_int(1,15),
        'bookDate' => $faker->dateTime(),
        'state' => 'Pendiente de confirmaçao',
    ];
});