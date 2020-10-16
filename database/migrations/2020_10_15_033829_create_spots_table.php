<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->string('name_es');
            $table->text('description_es');
            $table->string('name_en');
            $table->text('description_en');
            $table->string('address');
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('images');
            $table->bigInteger('category_id')->unsigned();
            // valoration => calculada
            // recommended => calculada
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
        Schema::dropIfExists('spots');
    }
}
