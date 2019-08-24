<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->integer('patient_age');
			$table->string('hospital_name');
			$table->string('hospital_address');
			$table->integer('blood_type_id');
			$table->string('phone');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->text('notes')->nullable();
			$table->integer('client_id');
			$table->integer('bags_number');
			$table->integer('city_id');

		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}