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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')
            ->constrained()
            ->reference('id')->on('organizations')
            ->cascadeOnDelete()->nullable();

            $table->foreignId('contact_id')
            ->constrained()
            ->reference('id')->on('contacts')
            ->cascadeOnDelete()->nullable();

            $table->decimal('value', 10, 2);
            $table->decimal('probability', 10, 2);
            $table->date('expected_close_date');
            $table->text('notes');
            $table->timestamps();
            //remember to add foreign keys
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
