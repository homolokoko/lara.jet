<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIntoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('locale')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('path')->nullable();
            $table->integer('dept')->nullable();
            $table->integer('weight')->nullable();
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
            $this->dropColumn('locale');
            $this->dropColumn('parent_id');
            $this->dropColumn('path');
            $this->dropColumn('dept');
            $this->dropColumn('weight');
        });
    }
}
