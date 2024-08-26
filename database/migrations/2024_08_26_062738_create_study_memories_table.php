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
            $table->foreignId('user_id')->unsigned()->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('study_at')->nullable();
            $table->string('event_title')->comment('イベント名');
            $table->string('event_body')->nullable()->comment('イベント内容');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->string('event_color')->comment('背景色');
            $table->string('event_border_color')->comment('枠線色');

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