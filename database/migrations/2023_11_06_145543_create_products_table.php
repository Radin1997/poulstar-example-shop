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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('off_price')->nullable();
            $table->json('photos');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('product_category')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('product_product_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('product_tag_id');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_tag_id')
                ->references('id')
                ->on('product_tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->primary(['product_id', 'product_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_product_tag');
        Schema::dropIfExists('products');
    }
};
