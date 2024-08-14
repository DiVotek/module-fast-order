<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\FastOrder\Models\FastOrder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(FastOrder::getDb(), function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('phone');
            $table->bigInteger('product_id');
            $table->boolean('status')->default(0);
            FastOrder::timestampFields($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(FastOrder::getDb());
    }
};
