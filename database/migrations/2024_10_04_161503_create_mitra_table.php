<?php

use App\Enums\MitraStatus;
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
        Schema::create('mitra', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_mitra')->nullable();
            $table->string('name_company');
            $table->string('phone_number', 20);
            $table->string('address')->nullable();
            $table->enum('status', array_column(MitraStatus::cases(), 'value'))->default(MitraStatus::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};
