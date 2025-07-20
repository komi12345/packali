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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_phone');
            $table->text('delivery_address');
            $table->decimal('total_price', 8, 2);
            $table->string('status')->default('pas encore livré'); // e.g., 'pas encore livré', 'livré'
            $table->date('order_date');
            $table->timestamps();
        });

        Schema::create('order_pack_alimentaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('pack_alimentaire_id')->constrained()->onDelete('cascade');
            $table->decimal('price_at_time', 8, 2);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
        Schema::create('order_pack_scolaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('pack_scolaire_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price_at_time', 10, 2); // Prix au moment de la commande
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pack_alimentaire');
        Schema::dropIfExists('orders');
    }
};
