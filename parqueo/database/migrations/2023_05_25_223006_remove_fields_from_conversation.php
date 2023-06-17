<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsFromConversation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropColumn('is_read');
            $table->dropColumn('message');
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->boolean('is_read')->nullable();
            $table->string('message')->nullable();
            $table->string('type')->nullable();
        });
    }
}
