<?php

use Illuminate\Contracts\Database\Query\Expression;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('identification_type', ['NIT', 'RUT', 'CC']);
            $table->integer('identification_number');
            $table->string('name', 50);
            $table->string('email');
            $table->string('address', 100);
            $table->string('phone_number', 14);
            $table->string('contact_name', 50);
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();
            $table->string('description', 40);
            $table->string('size');
            $table->string('color', 100);
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction')->unique();
            $table->timestamp('date_of_request')->nullable();
            $table->timestamp('date_of_delivery')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('client_id');
            $table->string('client_name');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->string('quantity_request_by_client', 40);
            $table->enum('state', ['new', 'in_process', 'shipped', 'finished']);
            
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('products');
        Schema::dropIfExists('orders');
    }
};
