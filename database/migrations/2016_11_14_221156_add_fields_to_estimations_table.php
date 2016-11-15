<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEstimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimations', function (Blueprint $table) {
            //
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->string('customer_address');
            $table->string('cc_email1');
            $table->string('cc_email2');
            $table->string('cc_email3');
            $table->string('cc_email4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimations', function (Blueprint $table) {
            //
            $table->dropColumn('customer_name');
            $table->dropColumn('customer_phone');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_address');
            $table->dropColumn('cc_email1');
            $table->dropColumn('cc_email2');
            $table->dropColumn('cc_email3');
            $table->dropColumn('cc_email4');
        });
    }
}
