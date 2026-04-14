<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // Open, In Progress, Resolved, Closed, Won't Fix
            $table->string('color', 20);   // hex color for UI badge
            $table->unsignedTinyInteger('order')->default(0);
        });
    }
 
    public function down(): void { Schema::dropIfExists('statuses'); }
};