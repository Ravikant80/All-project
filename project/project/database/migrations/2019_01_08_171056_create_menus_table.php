<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_group_id')->unsigned();
            $table->integer('parent_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('route')->nullable()->default(null);
            $table->string('params')->nullable()->default(null);
            $table->timestamps();

           // $table->foreign('menu_group_id')->references('id')->on('menu_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
