<?php

use App\Enums\ProjectStatus;
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
            $table->ulid('id')->primary();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('image', 255);
            $table->string('lokasi_kecamatan', 255);
            $table->timestamp('tanggal_awal');
            $table->timestamp('tanggal_akhir');
            $table->timestamp('tanggal_diterbitkan')->nullable();
            $table->enum('status', array_column(ProjectStatus::cases(), 'value'))->default(ProjectStatus::Draft->value);
            $table->foreignUlid('sektor_id')->constrained('sektors')->onDelete('cascade');
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
