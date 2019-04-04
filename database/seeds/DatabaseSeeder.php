<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // need create -> .env ADMIN_PASSWORD=pass
        // admin user default
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@dkpstat.com',
            'password' => bcrypt(ENV('ADMIN_PASSWORD')),
            'is_confirmed' => 1,
            'is_admine_CH777' => 1,
            'phone' =>'000000000',

        ]);
         $this->call(RoleSeeder::class);
         $this->call(AucStatuseSeeder::class);
         $this->call(ApplStatuses::class);
         $this->call(EventStatuses::class);
    }
}
