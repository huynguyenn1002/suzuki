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
        Schema::table('contract', function (Blueprint $table) {
            $table->string("broker_name", 256)->nullable()->after("gift");
            $table->string("broker_address", 256)->nullable()->after("gift");
            $table->string("broker_ic_card", 45)->nullable()->after("gift");
            $table->string("broker_phone", 45)->nullable()->after("gift");
            $table->string("amount_of_commission", 45)->nullable()->after("gift");
            $table->string("tax_issuance_date", 45)->nullable()->after("tax_code");
            $table->string("tax_issuance_place", 256)->nullable()->after("tax_code");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_broker_info');
    }
};
