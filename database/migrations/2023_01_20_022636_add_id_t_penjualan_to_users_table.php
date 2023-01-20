<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use doctrine\DBal;

class AddIdTPenjualanToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dt_penjualan', function (Blueprint $table) {
            $table->string('id_t_penjualan')->after('id_cart');
            $table->renameColumn('id_cart', 'id_dt_penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dt_penjualan', function (Blueprint $table) {
            //
        });
    }
}
