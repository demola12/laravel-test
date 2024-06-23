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
        Schema::create('websites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('url')->unique();
            $table->text('description')->nullable();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('category_id')->constrained('categories');
            $table->integer('vote_count')->default(0)->nullable();
            
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
