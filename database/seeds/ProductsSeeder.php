<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 10; $i++) {
                $product = new Product;
                $product->user_id = $user->id;
                $product->title = "Product $user->id-$i";
                $product->price = "${i}00";
                $product->save();
            }
        }

    }
}
