<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName', 100);
            $table->string('slug', 100);
            $table->bigInteger('catId')->unsigned();
            $table->bigInteger('brandId')->unsigned();
            $table->mediumText('detail');
            $table->float('price', 10, 2);
            $table->float('salePrice', 10, 2);
            $table->string('image', 100);
            $table->tinyInteger('popular')->default(0)->unsigned();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('products');
    }
};
