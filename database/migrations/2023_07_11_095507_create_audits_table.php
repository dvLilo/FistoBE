<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->integer('request_id');
            $table->date('date_received');
            $table->string('status');
            $table->foreignId('reason_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('transaction_no');
            $table->foreignId('user_id')->nullable()->constrained('users');
            // $table->string('transaction_type');
            $table->date('date_audit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audits');
    }
}
