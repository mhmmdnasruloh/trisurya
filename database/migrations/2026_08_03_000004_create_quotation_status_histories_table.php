<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('quotation_status_histories')) {
            Schema::create('quotation_status_histories', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('quotation_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('old_status')->nullable();
                $table->string('new_status');
                $table->text('note')->nullable();
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_status_histories');
    }
};
