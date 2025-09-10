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
        Schema::table('insp_inline_jobseq', function (Blueprint $table) {
            $table->foreign(['jobseq_id'], 'insp_inline_jobseq_ibfk_1')->references(['id'])->on('job_seqs');
            $table->foreign(['insp_inline_profile_id'], 'insp_inline_jobseq_ibfk_2')->references(['id'])->on('insp_inline_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_inline_jobseq', function (Blueprint $table) {
            $table->dropForeign('insp_inline_jobseq_ibfk_1');
            $table->dropForeign('insp_inline_jobseq_ibfk_2');
        });
    }
};
