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
        
        Schema::table('parcels', function (Blueprint $table) {
            $table->string('from_branch_details')->nullable()->after('status');
            $table->string('to_branch_details')->nullable()->after('to_branch_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('from_branch_details');
            $table->dropColumn('to_branch_details');
        }); 
    }
};
