<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryables', function (Blueprint $table) {
            // Полиморфная связь между таблицой Категорий и любыми другими таблицами
            $table->integer('category_id');
            // id поле таблицы связанной модели - это может быть id новости или id товара
            $table->integer('categoryable_id');
            // значение связанной модели, здесь указывается связанная модель, в которой искать значение поля categoryable_id
            $table->string('categoryable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoryables');
    }
}
