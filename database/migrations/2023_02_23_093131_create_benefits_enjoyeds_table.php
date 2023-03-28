<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitsEnjoyedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits_enjoyeds', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 255)->unique();
            $table->text('content')->nullable();
            $table->string('object', 255)->unique();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('benefits_enjoyeds');
    }
}
