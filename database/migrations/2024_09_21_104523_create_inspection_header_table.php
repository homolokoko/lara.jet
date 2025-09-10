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
        Schema::create('inspection_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no', 100)->nullable();
            $table->integer('buyer_id')->nullable()->index();
            $table->integer('doc_type')->nullable()->index();
            $table->integer('inspector_id')->nullable()->index();
            $table->integer('po_qty')->nullable()->default(0);
            $table->integer('actual_carton_qty')->nullable()->default(0);
            $table->integer('actual_measurement_qty')->nullable()->default(0);
            $table->boolean('is_complete')->nullable()->default(false);
            $table->boolean('got_workmanship')->nullable()->default(false);
            $table->boolean('got_measurement')->nullable()->default(false);
            $table->boolean('got_label_print_mark')->nullable()->default(false);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('aql_critical_id')->nullable()->index();
            $table->integer('aql_major_id')->nullable()->index();
            $table->integer('aql_minor_id')->nullable()->index();
            $table->integer('aql_inspect_level_id')->nullable()->index();
            $table->integer('suggest_workmanship_pcs')->nullable()->default(0);
            $table->string('suggest_measurement_pcs')->nullable();
            $table->integer('suggestion_carton')->nullable()->default(0);
            $table->integer('major_defect_accept')->nullable()->default(0);
            $table->integer('minor_defect_accept')->nullable()->default(0);
            $table->integer('critical_defect_accept')->nullable()->default(0);
            $table->integer('actual_major_defect')->nullable()->default(0);
            $table->integer('actual_minor_defect')->nullable()->default(0);
            $table->integer('actual_critical_defect')->nullable()->default(0);
            $table->integer('workmanship_is_pass')->nullable()->default(0);
            $table->integer('company_id')->nullable()->index();
            $table->string('contact_to')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('factory_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_header');
    }
};
