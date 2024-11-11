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
        Schema::create('biographs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nik');
            $table->string('surename');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('address');
            $table->string('religion');
            $table->string('marriage_status');
            $table->string('job');
            $table->foreignId('file_id')->nullable()->constrained('files')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biographs');
    }
};
