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
        Schema::create('study_memories', function (Blueprint $table) {
        $table->id();
        $table->string('event_title')->comment('科目名');
        $table->string('event_body')->nullable()->comment('科目内容');
        $table->timestamp('start_date')->nullable()->comment('開始日');
        $table->timestamp('end_date')->nullable()->comment('終了日');
        $table->string('event_color')->comment('背景色');
        $table->string('event_border_color')->comment('枠線色');
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_memories');
    }
};
