<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCiToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ci')->nullable();
            $table->string('celular')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            $table->unsignedBigInteger('unidad_id')->nullable();
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['unidad_id']);
            $table->dropForeign(['cargo_id']);
            $table->dropColumn(["ci", "celular", "cargo_id", "unidad_id"]);
        });
    }
}
