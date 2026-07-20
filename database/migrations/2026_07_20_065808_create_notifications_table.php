<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('loan_id')
                ->nullable()
                ->constrained('loans')
                ->nullOnDelete();

            $table->string('title', 150);

            $table->text('message');

            $table->enum('type', [
                'reminder',
                'approval',
                'return',
                'overdue',
                'fine',
                'system',
            ]);

            $table->boolean('is_read')
                ->default(false);

            $table->dateTime('read_at')
                ->nullable();

            $table->dateTime('sent_at')
                ->nullable();

            $table->timestamps();

            $table->index('type');
            $table->index('is_read');
            $table->index(['user_id', 'is_read']);
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
