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
        Schema::create('markers_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->charset('utf8mb4')->collation('utf8mb4_bin')->nullable();
            $table->string('marker_uuid')->charset('utf8mb4')->collation('utf8mb4_bin')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('path')->nullable();
            $table->string('format')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markers_attachments');
    }
};
