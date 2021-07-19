<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->string('organization');
            $table->integer('applied_amount');
            $table->string('description')->nullable();
            $table->text('notes')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('status')->default('application');
            $table->boolean('is_completed')->default(false);
            $table->date('decision_date')->nullable();
            $table->date('submitted_date');
            $table->date('awarded_date')->nullable();
            $table->date('spend_by_date')->nullable();
            $table->date('reporting_date')->nullable();
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
        Schema::dropIfExists('grants');
    }
}
