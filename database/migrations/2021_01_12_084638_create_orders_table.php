<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderStatus;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->default('')->nullable();
            $table->foreignId('products_id')->constrained('products');
            $table->foreignId('batchs_id')->constrained('batchs');
            $table->double('qty',5,2);
            $table->double('unitprice',5,2);
            $table->double('discount',5,2);
            $table->double('lineamount',5,2);
            $table->enum('type', OrderStatus::getValues())
                ->default(OrderStatus::Open);
            $table->string('packingid');
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
        Schema::dropIfExists('orders');
    }
}
