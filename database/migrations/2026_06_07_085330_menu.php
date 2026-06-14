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
        //
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('name');
            $table->float('price_usd');
            $table->integer('quantity');
            $table->unsignedInteger('cat_id');
            $table->timestamps();
 
            $table->foreign('cat_id')
                  ->references('cat_id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('menu');
    }
};
