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
        Schema::create('cutting_recap_panel', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('stack_position', 100)->nullable()->index('cutting_checkpoint_id');
            $table->integer('cutting_panel_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('cutting_check_cutPanel_id')->nullable();
            $table->integer('cutting_recap_id')->index('cutting_recap_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_recap_panel');
    }
};
