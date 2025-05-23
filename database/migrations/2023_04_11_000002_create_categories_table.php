<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img')->nullable();

            $table->timestamps();
        });

        DB::table('categories')->insert([
            'title' => 'initial', 
            'img' => 'https://cdn.dribbble.com/userupload/43423073/file/original-167c772b052b15ca80a6c8ac8fc598a9.jpg?resize=1600x1200&vertical=center'
        ]);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
