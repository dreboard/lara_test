<?php

use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('isAdmin')->default(0);
            $table->string('profile_img')->default(public_path('img/blank_profile.png'));
            $table->morphs('groupable');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'name' => 'Admin Man',
                'email' => 'dre.board@gmail.com',
                'password' => bcrypt('test1234'),
                'isAdmin' => 1,
                'profile_img' => public_path('img/blank_profile.png'),
                'groupable_id' => 1,
                'groupable_type' => 'team'// App\Team

            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Guest Man',
                'email' => 'guest@guest.com',
                'password' => bcrypt('test1234'),
                'isAdmin' => 0,
                'groupable_id' => 2,
                'groupable_type' => 'team' // App\Team
            ]
        );

        $seed = new UserSeeder(); // create 8
        $seed->run();
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
