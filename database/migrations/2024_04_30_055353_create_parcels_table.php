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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_address');
            $table->string('sender_contact');
            $table->string('recipient_name');
            $table->string('recipient_address');
            $table->string('recipient_contact');
            $table->boolean('type')->default(0); // 0 for Pickup, 1 for Deliver
            $table->foreignId('from_branch_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('to_branch_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->decimal('weight', 8, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('length', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
