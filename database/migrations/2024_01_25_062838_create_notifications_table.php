<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            // MySQLの場合、外部キー制約を持つテーブルはパーティションを設定することはできない模様
            // $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('user_id');
            // $table->timestamps() の形式ではデータ型がパーティショニングに対応していない模様
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at');
            $table->softDeletes();
            /**
             * created_atをもとにパーティションを設定するので主キーに含めるの必要がある
             * created_atにして複合主キーにする必要があるがこの場合パフォーマンス等の懸念はある
             */
            $table->index(['user_id', 'created_at']);
            $table->primary(['id', 'user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
