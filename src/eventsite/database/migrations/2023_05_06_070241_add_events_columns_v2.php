<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsColumnsV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->string('title');
            $table->string('image');
            $table->text('body');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('finish_date')->nullable();
            $table->string('situation');
            $table->string('venue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->dropColumn('title');
            $table->dropColumn('image');
            $table->dropColumn('body');
            $table->dropColumn('start_date');
            $table->dropColumn('finish_date');
            $table->dropColumn('situation');
            $table->dropColumn('venue');
        });
    }


}
