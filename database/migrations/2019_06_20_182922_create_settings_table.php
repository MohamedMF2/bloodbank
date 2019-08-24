<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->timestamps();
			$table->increments('id');
			$table->string('phone');
			$table->string('email');
			$table->string('facebook');
			$table->string('whatsapp');
			$table->string('twitter');
			$table->string('instagram');
			$table->string('youtube');
			$table->string('linkedin');
			$table->string('google');
			$table->string('about');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}