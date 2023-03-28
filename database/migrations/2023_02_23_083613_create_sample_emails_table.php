<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_emails', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('title', 255);
            $table->text('description')->nullable();
            // khoa ngoại bảng ứng viên
            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')->references('id')->on('candidates');

            $table->string('name_HR', 255);
            // khoa ngoại bảng vi trí tuyển dụng
            $table->unsignedBigInteger('vacancie_id');
            $table->foreign('vacancie_id')->references('id')->on('vacancies');
            $table->text('address')->nullable();
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
        Schema::dropIfExists('sample_emails');
    }
}
