<?php

use Illuminate\Database\Seeder;

class AucStatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('auc_statuses')->insert([
            'name' => 'NEW'
        ]);
        //2
        DB::table('auc_statuses')->insert([
            'name' => 'Purchased'
        ]);
        //3
        DB::table('auc_statuses')->insert([
            'name' => 'CLOSE'
        ]);
        //4
        DB::table('auc_statuses')->insert([
            'name' => 'Del'
        ]);

    }
}
