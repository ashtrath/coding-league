<?php

use App\Enums\LaporanStatus;
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
        Schema::create('laporans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title', 255);
            $table->enum('status', array_column(LaporanStatus::cases(), 'value'))->default(LaporanStatus::Pending->value);
            $table->text('description');
            $table->decimal('anggaran_realisasi', 10,2);
            $table->timestamp('tanggal_realisasi');
            $table->timestamp('tanggal_diterbitkan')->nullable();
            $table->string('lokasi_kecamatan', 255)->nullable();
            $table->foreignUlid('mitra_id')->constrained('mitras')->onDelete('cascade');
            $table->foreignUlid('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->foreignUlid('project_id')->constrained('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
