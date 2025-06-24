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
        Schema::create('pack_alimentaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->text('contenu'); // Pourrait être JSON si la structure est complexe
            $table->decimal('prix', 8, 2);
            $table->string('image')->nullable();
            $table->string('tag')->nullable(); // Ex: Populaire, Économique, Premium
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_alimentaires');
    }
};
