<?php

use App\Enums\ProductionStatus;
use App\Enums\TableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::REQUEST_PRODUCTION(), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("product_id");
            $table->integer("request_quantity")->default(0);
            $table->integer("actual_quantity")->default(0);
            $table->enum("status", ProductionStatus::values())->default(ProductionStatus::WAITING());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TableEnum::REQUEST_PRODUCTION());
    }
}
