<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddRecruitmentRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_recruitment_rounds', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 255)->unique();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('type_of_recruitment_round_id');
            $table->foreign('type_of_recruitment_round_id')->references('id')->on('type_of_recruitment_rounds');
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
        Schema::dropIfExists('add_recruitment_rounds');
    }
}
