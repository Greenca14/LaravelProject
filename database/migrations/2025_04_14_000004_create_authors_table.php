<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('authors', function (Blueprint $table) {
        $table->id();
        $table->foreignId('publication_id')->constrained('publications')->onDelete('cascade');
        $table->foreignId('person_id')->constrained('persons')->onDelete('cascade'); // ← исправлено на persons
        $table->decimal('contribution_share', 5, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
