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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('build_tags')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->json('feature_images')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->text('overview')->nullable();
            $table->text('features')->nullable();
            $table->text('technology_used')->nullable();
            $table->text('future_improvement')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
