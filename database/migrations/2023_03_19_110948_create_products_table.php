<?php

use App\Models\Category;
use Brick\Math\BigInteger;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Category::class)->nullable()->constrained('categories')->onDelete('set null');
            // $table->foreignId('category_id')->constrained('categories');
            $table->BigInteger('category_id'); //->default(null);
            $table->string('name');
            $table->string('code');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->double('price')->default(0);
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
        Schema::dropIfExists('products');
    }
};
