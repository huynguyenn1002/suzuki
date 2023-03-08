<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->integer("contract_num");
            $table->integer("contract_type")->nullable();
            $table->date("contract_sign_date")->nullable();
            $table->integer("admin_id")->nullable();
            $table->string("customer_name")->nullable();
            $table->smallInteger("customer_gender")->nullable();
            $table->date("customer_birthday")->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('province_name', 256)->nullable();
            $table->string('district_name', 256)->nullable();
            $table->string('ward_name', 256)->nullable();
            $table->string('address', 256)->nullable();
            $table->integer('customer_phone')->nullable();
            $table->integer('customer_id_card')->nullable();
            $table->date('customer_id_card_register')->nullable();
            $table->string('issued_by', 256)->nullable();
            $table->string('mail_address', 256)->nullable();
            $table->integer('car_id')->nullable();
            $table->integer('car_color')->nullable();
            $table->integer('real_price')->nullable();
            $table->integer('invoice_selling_price')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('deposit')->nullable();
            $table->date('carDeliveryTime')->nullable();
            $table->string('promotion', 256)->nullable();
            $table->string('gift', 256)->nullable();
            $table->integer('chassis_number')->nullable();
            $table->integer('engine_number')->nullable();
            $table->date('pdi_time')->nullable();
            $table->date('pdi_confirm_time')->nullable();
            $table->string('note', 256)->nullable();
            $table->date('dnxhs_date')->nullable();
            $table->integer('payment_amount')->nullable();
            $table->integer('receiptType')->nullable();
            $table->string('banking_from', 256)->nullable();
            $table->string('banking_to', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
};
