<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->string('name');
            $table->decimal('footage');
            $table->string('bedrooms');
            $table->decimal('bathroom');
            $table->text('description');
            
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
		Schema::drop('units');
	}

}
