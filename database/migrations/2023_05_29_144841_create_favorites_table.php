<?php

use App\Enums\TableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(TableEnum::MARKABLE_FAVORITES(), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->morphs('markable');
            $table->string('value')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableEnum::MARKABLE_FAVORITES());
    }
};
