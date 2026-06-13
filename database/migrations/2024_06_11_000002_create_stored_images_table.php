<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stored_images', function (Blueprint $table) {
            $table->id();
            $table->string('path')->unique();
            $table->string('disk')->default('public');
            $table->string('folder');
            $table->unsignedInteger('file_size')->default(0);
            $table->string('mime_type')->default('image/jpeg');
            $table->string('original_name')->nullable();
            $table->nullableMorphs('imageable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stored_images');
    }
};
