<?php

use Illuminate\Database\Seeder;

class ApplStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appl_statuses')->insert(array(
            0 => 
            array (
                'id' => 1,
                'name' => 'Reqruit',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Success',
            ),
            2 => 
            array ( 
                'id' => 3,
                'name' => 'Cencel',
            ),
        ));
        // DB::table('appl_statuses')->insert([
        //     'name' => 'Reqruit'
        // ]);
        // DB::table('appl_statuses')->insert([
        //     'name' => 'Success'
        // ]);
        // DB::table('appl_statuses')->insert([
        //     'name' => 'Cencel'
        // ]);

    }
}
