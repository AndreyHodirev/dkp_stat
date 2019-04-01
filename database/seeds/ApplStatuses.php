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
        DB::table('appl_statuses')->insert([
            'name' => 'Reqruit'
        ]);
        DB::table('appl_statuses')->insert([
            'name' => 'Success'
        ]);
        DB::table('appl_statuses')->insert([
            'name' => 'Cencel'
        ]);

    }
}
