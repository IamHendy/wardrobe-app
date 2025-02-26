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
        Schema::create('cloths', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Cloth name
            $table->string('category'); // Category (e.g., Tops, Pants)
            $table->string('image_url')->nullable(); // Image URL (optional)
            $table->boolean('isFavorite')->default(false); // Favorite flag
            // Add user_id as a foreign key referencing the users table.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cloths');
    }
};

