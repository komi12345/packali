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
        Schema::create('pack_scolaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->text('contenu'); // Liste des fournitures incluses
            $table->decimal('prix', 8, 2);
            $table->string('image')->nullable();
            $table->string('tag')->nullable(); // Ex: Primaire, Secondaire, Universitaire
            $table->string('niveau_scolaire')->nullable(); // CP, CE1, 6ème, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_scolaires');
    }
};
