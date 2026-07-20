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
        Schema::create('loan_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('loan_id')
                ->constrained('loans')
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->constrained('books')
                ->restrictOnDelete();

            $table->dateTime('returned_at')->nullable();

            $table->enum('condition_on_return', [
                'good',
                'damaged',
                'lost',
            ])->nullable();

            $table->decimal('fine_amount', 12, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['loan_id', 'book_id']);
            $table->index('returned_at');
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_items');
    }
};
