<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutivesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("executives", function (Blueprint $table) {
      $table->id();
      $table->foreignId("transaction_id")->constrained("transactions");
      $table->date("date_received");
      $table->string("status");
      $table
        ->foreignId("reason_id")
        ->nullable()
        ->constrained("reasons");
      $table->string("remarks")->nullable();
      $table
        ->foreignId("user_id")
        ->nullable()
        ->constrained("users");
      $table->date("date_signed")->nullable();
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
    Schema::dropIfExists("executives");
  }
}
