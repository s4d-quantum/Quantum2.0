<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('tbl_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->index();
            $table->string('item_imei', 100)->nullable();
            $table->date('date');
            $table->string('supplier_id', 10);
            $table->string('tray_id', 100)->nullable();
            $table->integer('qc_required')->nullable();
            $table->integer('qc_completed')->nullable();
            $table->integer('repair_required')->nullable();
            $table->integer('repair_completed')->nullable();
            $table->integer('purchase_return')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('report_comment', 500)->nullable();
            $table->string('po_ref', 50)->nullable();
            $table->integer('has_return_tag')->nullable();
            $table->integer('unit_confirmed')->nullable();
            // Uncomment the following line if you want to include Laravel's timestamp columns
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_purchases');
    }
}
