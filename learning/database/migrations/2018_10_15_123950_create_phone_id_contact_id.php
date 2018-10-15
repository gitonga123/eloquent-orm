<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneIdContactId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('contacts', function($table)
//        {
//            $table->integer('phone_id')->unsigned();
//        });

        Schema::table('phone_numbers', function($table)
        {
            $table->integer('contact_id')->unsigned();
        });

        Schema::table('contacts', function($table)
        {
            $table->integer('phone_id')->unsigned();
        });

        Schema::table('users', function($table)
        {
            $table->integer('phone_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_numbers', function($table)
        {
            $table->dropColumn('contact_id');
        });

        Schema::table('contacts', function($table)
        {
            $table->dropColumn('phone_id');
        });

        Schema::table('users', function($table)
        {
            $table->dropColumn('phone_id');
        });
    }
}
