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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->string('title');
            $table->string('title_id')->nullable();
            $table->string('title_ch')->nullable();
            $table->string('slug')->nullable();
            $table->string('slug_id')->nullable();
            $table->string('lead')->nullable();
            $table->string('lead_id')->nullable();
            $table->string('lead_ch')->nullable();
            $table->text('description');
            $table->string('description_id')->nullable();
            $table->string('description_ch')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->integer('category_id');
            $table->string('impression')->nullable();
            $table->string('impression_id')->nullable();
            $table->string('impression_ch')->nullable();
            $table->string('keywords')->nullable();
            $table->string('author')->nullable();
            $table->string('stay_for')->nullable();
            $table->string('stay_for_id')->nullable();
            $table->string('stay_for_ch')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
