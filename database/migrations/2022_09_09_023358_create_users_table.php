<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    const TABLE_NAME = 'users';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if ( Schema::hasTable( static::TABLE_NAME ) ) return;


        Schema::create( static::TABLE_NAME, function ( Blueprint $table ) {

            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('city');
            $table->rememberToken();
            $table->timestamps();

        } );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( static::TABLE_NAME );
    }
}
