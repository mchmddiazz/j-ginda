<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Enums\TableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::ORDERS(), function (Blueprint $table) {
            $table->id('id');
            $table->string('order_number')->unique();
            $table->foreignId('user_id');
            $table->enum('status', OrderStatus::values())->default(OrderStatus::PENDING());
            $table->decimal('grand_total', 20, 2)->default(0);
            $table->unsignedInteger('item_count')->default(0);
            $table->enum('payment_status', PaymentStatusEnum::values())->default(PaymentStatusEnum::WAITING());
            $table->string("tracking_number")->nullable();
            $table->double("ongkir")->default(0);
            $table->integer("weight")->default(0);
            $table->unsignedInteger("province_id")->nullable();
            $table->unsignedInteger("city_id")->nullable();
            $table->string("postal_code")->nullable();
            $table->string('phone_number')->nullable();
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string("expedisi")->nullable();
            $table->boolean("is_custom_address")->default(false);
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
        Schema::dropIfExists(TableEnum::ORDERS());
    }
}
