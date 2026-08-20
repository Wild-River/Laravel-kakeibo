<?php

use App\Models\Category;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();  // 新しい書き方！categories.id
            $table->string('type')->default('expense')->comment('収支タイプ');            // income / expense
            $table->unsignedInteger('amount')->comment('金額');                     // 金額
            $table->date('occurred_at')->comment('取引日');                            // 取引が発生した日
            $table->string('note')->nullable()->comment('備考');                    // メモ（nullを許容）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
