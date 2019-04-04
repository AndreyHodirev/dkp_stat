<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            0 => 
            array(
                'id' => 1,
                'role_name' => 'Guild Leader',
                'role_description' => 'When a guild is created - the user who created it gets this rank',
            ),
            1 =>
            array(
                'id' => 2,
                'role_name' => 'Guild Officer',
                'role_description' => 'Awarded by guild leader or other officer. Has the right to admission 
                                to the guild, creating events, expulsion from the guild, the creation of auctions',
            ),
            2 =>
            array(
                'id' => 3,
                'role_name' => 'Guild Member',
                'role_description' => 'Assigned after joining the guild',
            ),
            3 => 
            array(
                'id' => 4,
                'role_name' => 'Recruit',
                'role_description' => 'It is assigned after sending the entry request.',
            ),
            4 =>
            array(
                'id' => 5,
                'role_name' => 'Activated',
                'role_description' => 'Assigned after profile activation (email).',    
            ),
            5 =>
            array(
                'id' => 6,
                'role_name' => 'Not activated',
                'role_description' => 'It is assigned during registration without confirmation email.',    
            )
        ));
        // DB::table('roles')->insert([
        //     'role_name' => 'Guild Leader',
        //     'role_description' => 'When a guild is created - the user who created it gets this rank',
        // ]);
        // DB::table('roles')->insert([
        //     'role_name' => 'Guild Officer',
        //     'role_description' => 'Awarded by guild leader or other officer. Has the right to admission 
        //                         to the guild, creating events, expulsion from the guild, the creation of auctions',
        // ]);
        // DB::table('roles')->insert([
        //     'role_name' => 'Guild Member',
        //     'role_description' => 'Assigned after joining the guild',
        // ]);
        // DB::table('roles')->insert([
        //     'role_name' => 'Recruit',
        //     'role_description' => 'It is assigned after sending the entry request.',
        // ]);
        // DB::table('roles')->insert([
        //     'role_name' => 'Activated',
        //     'role_description' => 'Assigned after profile activation (email).',
        // ]);
        // DB::table('roles')->insert([
        //     'role_name' => 'Not activated',
        //     'role_description' => 'It is assigned during registration without confirmation email.',
        // ]);

    }
}
