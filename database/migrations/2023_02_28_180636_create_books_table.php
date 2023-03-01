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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->string('author', 100)->nullable();
            $table->string('isbn')->unique();
            $table->date('publishedAt')->nullable();
            $table->string('publisher')->nullable();
            $table->string('genre')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();;
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
        Schema::dropIfExists('books');
    }
};
