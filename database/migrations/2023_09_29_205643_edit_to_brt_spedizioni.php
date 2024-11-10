<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brt_spedizioni', function (Blueprint $table) {
            $table->string('cap_mittente', 9)->nullable()->after('nome_mittente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brt_spedizioni', function (Blueprint $table) {
            //
        });
    }
};