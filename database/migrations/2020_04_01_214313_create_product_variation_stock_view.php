<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP VIEW IF EXISTS stocks_view');
        DB::statement('DROP VIEW IF EXISTS product_variation_order_view');
        DB::statement('DROP VIEW IF EXISTS product_variation_stock_view');
        
        DB::statement("
            CREATE VIEW stocks_view AS
                 SELECT
                     stocks.product_variation_id as id,
                        SUM(stocks.quantity) as quantity
                    FROM stocks
                    GROUP BY stocks.product_variation_id
        ");

        DB::statement("
            CREATE VIEW product_variation_order_view AS 
                 SELECT
                     product_variation_order.product_variation_id as id,
                        SUM(product_variation_order.quantity) as quantity
                    FROM product_variation_order
                    Group BY product_variation_order.product_variation_id
        ");

        DB::statement("
            CREATE VIEW product_variation_stock_view AS
                SELECT
                    product_variations.product_id AS product_id,
                    product_variations.id as product_variation_id,
                    COALESCE(SUM(stocks.quantity) - COALESCE(SUM(product_variation_order.quantity), 0), 0) as stock,
                    CASE WHEN COALESCE(SUM(stocks.quantity) - COALESCE(SUM(product_variation_order.quantity), 0), 0) > 0
                        THEN true
                        ELSE false
                    END in_stock    
                FROM product_variations
                LEFT JOIN stocks_view
                    AS stocks USING (id)
                LEFT JOIN product_variation_order_view
                    AS product_variation_order USING(id)
                    GROUP BY product_variations.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS stocks_view');
        DB::statement('DROP VIEW IF EXISTS product_variation_order_view');
        DB::statement('DROP VIEW IF EXISTS product_variation_stock_view');
    }
}
            