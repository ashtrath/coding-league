<?php

use App\Enums\KegiatanStatus;
use App\Models\Kegiatan;
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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->enum('status', array_column(KegiatanStatus::cases(), 'value'))->default(KegiatanStatus::Draft->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};