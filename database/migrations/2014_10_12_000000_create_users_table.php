<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_admine_CH777')->default(false);
            $table->integer('guild_id')->nullable();
            $table->string('phone')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role_id')->default(6);
            // ID 6 = Not activated
            // ID 5 = Activated
            // ID 4 = Recruit
            // ID 3 = Guild Member 
            // ID 2 = Guild Officer 
            // ID 1 = Guild Leader 
            $table->string('password');
            $table->rememberToken();
            $table->string('confirmation_token')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
