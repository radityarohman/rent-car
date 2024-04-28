<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tenant");
            $table->integer("id_penalties")->references("id")->on("penalties")->onDelete("cascade");
            $table->string("no_car");
            $table->date("date_borrow");
            $table->date("date_return");
            $table->integer("discount")->nullable();
            $table->integer("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_cars');
    }
};
