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
        DB::table('auc_statuses')->insert(array(
            0 => 
            array (
                'id' => 1,
                'name' => 'NEW',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Purchased',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'CLOSE',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'del',
            ),
        ));
        // //1
        // DB::table('auc_statuses')->insert([
        //     'name' => 'NEW'
        // ]);
        // //2
        // DB::table('auc_statuses')->insert([
        //     'name' => 'Purchased'
        // ]);
        // //3
        // DB::table('auc_statuses')->insert([
        //     'name' => 'CLOSE'
        // ]);
        // //4
        // DB::table('auc_statuses')->insert([
        //     'name' => 'Del'
        // ]);

    }
}
