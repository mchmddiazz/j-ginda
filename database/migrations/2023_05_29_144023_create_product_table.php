<?php

use App\Enums\TableEnum;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::PRODUCTS(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->double('priceDisc')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('quantity_threshold')->default(0);
            $table->integer('weight')->default(0);
            $table->string('image')->nullable();
            $table->boolean('slideActive');
            $table->text('description')->nullable();
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
        Schema::dropIfExists(TableEnum::PRODUCTS());
    }
}
