<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReefersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reefers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vessel_id')->constrained('vessels')->onDelete('cascade');
            $table->string('ctr_id');
            $table->string('ISO');
            $table->decimal('temperature');
            $table->string('LOP');
            $table->string('current_LOC');
            $table->string('plug_status');
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
        Schema::dropIfExists('reefers');
    }
}
