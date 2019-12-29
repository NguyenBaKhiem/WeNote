<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('note_flag_id');

            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();

            $table->string('longitude');
            $table->string('latitude');
            $table->string('osm_id');
            $table->string('osm_type');
            $table->string('osm_key');
            $table->string('osm_value');
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();

            $table->boolean('is_public')->comment('1:Public/0:Private');
            $table->boolean('is_active')->comment('1:Active/0:Inactive');

            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('notes');
    }
}
