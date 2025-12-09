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
        Schema::create('footers_section', function (Blueprint $table) {
            $table->id();
            $table->string('col_1_title');
            $table->string('col_1_body_1');
            $table->string('col_1_body_2')->nullable();
            $table->string('col_2_title');
            $table->string('col_2_body');
            $table->string('col_3_title');
            $table->string('col_3_body');
            $table->string('telegram_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('copyright');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers_section');
    }
};
