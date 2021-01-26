<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function createView(): string{
        return
            "create view view_product_price
            as
            Select products.id as product_id, description as product_desc, batchs.id as batch_id,
            batchs.name as batch_name, batchs.active as batch_active, batchs.expirydatetime as batch_expirydatetime, prices.fromqty as price_fromqty, prices.toqty as price_toqty, prices.salesprice as price_salesprice from products
            join Batchs
            on batchs.products_id = products.id
            join prices
            on prices.Batchs_id = batchs.id"
            ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return

            "DROP VIEW IF EXISTS `view_product_price`";

    }
}
