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
        Schema::table('promotions', function (Blueprint $table) {
            // Ajouter les colonnes pour les packs scolaires
            $table->unsignedBigInteger('pack_scolaire_id')->nullable()->after('pack_alimentaire_id');
            $table->string('type_pack')->default('alimentaire')->after('pack_scolaire_id'); // 'alimentaire' ou 'scolaire'
            
            // Ajouter les index
            $table->foreign('pack_scolaire_id')->references('id')->on('pack_scolaires')->onDelete('cascade');
            $table->index(['type_pack']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropForeign(['pack_scolaire_id']);
            $table->dropIndex(['type_pack']);
            $table->dropColumn(['pack_scolaire_id', 'type_pack']);
        });
    }
};
