<?php

use App\Enums\TableEnum;
use App\Enums\TransactionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::ORDER_ITEMS(), function (Blueprint $table) {
            $table->id('id');
            $table->string("code")->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 20, 6)->nullable();
            $table->enum("type", TransactionTypeEnum::values())->default(TransactionTypeEnum::OUT());
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
        Schema::dropIfExists(TableEnum::ORDER_ITEMS());
    }
}
