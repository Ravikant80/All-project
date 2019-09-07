<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('orders')->insert([
            'user_id' => 1,
            'item_id' => 1
        ]);
        DB::table('orders')->insert([
            'user_id' => 1,
            'item_id' => 5
        ]);
        DB::table('orders')->insert([
            'user_id' => 2,
            'item_id' => 2
        ]);
        DB::table('orders')->insert([
            'user_id' => 4,
            'item_id' => 3
        ]);
        DB::table('orders')->insert([
            'user_id' => 5,
            'item_id' => 1
        ]);
    }
}
