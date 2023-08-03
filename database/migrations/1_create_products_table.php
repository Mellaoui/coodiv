<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // -- Foreign Keys -- //

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('matiere_id')->constrained()->cascadeOnDelete();

            // -- Product Attributes -- //

            $table->string('reference');
            $table->string('designation');
            $table->integer('buy_price');
            $table->integer('sell_price');
            $table->integer('weight');
            $table->decimal('discount')->default(0);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
