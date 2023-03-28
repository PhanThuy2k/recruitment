<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->unsignedBigInteger('group_reason_types_id');
            $table->foreign('group_reason_types_id')->references('id')->on('group_reason_types');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('type_reasons');
    }
}
