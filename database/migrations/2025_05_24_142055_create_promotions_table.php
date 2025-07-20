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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pack_alimentaire_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('pack_scolaire_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('type_pack')->default('alimentaire'); // 'alimentaire' ou 'scolaire'
            $table->decimal('prix_promotionnel', 8, 2);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();

            $table->index(['type_pack']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
