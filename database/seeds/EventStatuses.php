<?php

use Illuminate\Database\Seeder;

class EventStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('event_statuses')->insert(array(
            0 => 
            array (
                'id' => 1,
                'name' => 'New Event',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'In the process',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Close',
            ),
        ));
        // DB::table('event_statuses')->insert([
        //     'name' => 'New Event',
        // ]);
        // DB::table('event_statuses')->insert([
        //     'name' => 'In the process',
        // ]);
        // DB::table('event_statuses')->insert([
        //     'name' => 'Close',
        // ]);
    }
}
