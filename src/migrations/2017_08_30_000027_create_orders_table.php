<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'orders';

    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
           
            $table->increments('id');
            $table->decimal('total');
            $table->float('vat_used');
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('address_shipping_id')->unsigned()->nullable();
            $table->integer('address_payment_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('shipping_method_id')->unsigned()->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->string('command_number');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('address_shipping_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipping_id')->references('id')->on('shippings');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('address_payment_id')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}
