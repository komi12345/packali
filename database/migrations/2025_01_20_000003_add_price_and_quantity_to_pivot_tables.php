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
        // Vérifier si les colonnes n'existent pas déjà avant de les ajouter
        if (!Schema::hasColumn('order_pack_alimentaire', 'price_at_time')) {
            Schema::table('order_pack_alimentaire', function (Blueprint $table) {
                $table->decimal('price_at_time', 8, 2)->after('pack_alimentaire_id');
                $table->integer('quantity')->default(1)->after('price_at_time');
            });
        }

        if (!Schema::hasColumn('order_pack_scolaire', 'price_at_time')) {
            Schema::table('order_pack_scolaire', function (Blueprint $table) {
                $table->decimal('price_at_time', 8, 2)->after('pack_scolaire_id');
                $table->integer('quantity')->default(1)->after('price_at_time');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_pack_alimentaire', function (Blueprint $table) {
            $table->dropColumn(['price_at_time', 'quantity']);
        });

        Schema::table('order_pack_scolaire', function (Blueprint $table) {
            $table->dropColumn(['price_at_time', 'quantity']);
        });
    }
};
