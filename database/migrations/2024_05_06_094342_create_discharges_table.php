<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDischargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained('vessels');
            $table->foreignId('reefer_id')->constrained('reefers');
            $table->dateTime('arrival_time')->nullable();
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
        Schema::dropIfExists('discharges');
    }
}
