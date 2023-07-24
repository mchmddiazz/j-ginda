<?php

use App\Enums\FinancialTransactionTypeEnum;
use App\Enums\TableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::TRANSACTIONS(), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->nullable();
            $table->unsignedInteger("order_id")->nullable();
            $table->string("description")->nullable();
            $table->decimal("amount", 20, 2)->default(0);
            $table->decimal("saldo", 20, 2);
            $table->enum("type", FinancialTransactionTypeEnum::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TableEnum::TRANSACTIONS());
    }
}
