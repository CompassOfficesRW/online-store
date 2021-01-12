<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensionvalues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dimensions_id')->constrained('dimensions')
                ->onDelete('cascade');
            $table->string('value');
            $table->integer('stock')->default(99);
            $table->boolean('unlimited')->default(true);
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
        Schema::dropIfExists('dimensionvalues');
    }
}
