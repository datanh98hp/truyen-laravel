<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('store_name')->nullable();
            $table->string('banner')->nullable();
            $table->string('contentBanner_left')->nullable();
            $table->string('contentBanner_right')->nullable();
            $table->string('contentBanner_heading')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('pos_code')->nullable();
            $table->string('opentime')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('map_key')->nullable();
    
        });
        DB::table('settings')->insert([
            'logo' => 'https://cdn.dribbble.com/userupload/43422245/file/original-c055b17830f55b3e7b880177c2bb294c.jpg?resize=1024x768&vertical=center',
            'store_name' => 'initial',
            'banner' => 'https://cdn.dribbble.com/userupload/15935739/file/original-7bc2d37e1e3ee1b1cecb95ab0924de74.jpg?resize=1024x768&vertical=center',
            'contentBanner_left' => 'https://cdn.dribbble.com/userupload/43422246/file/original-db4d2ddd6bd6db524a3c3717da26af6a.jpg?resize=752x564&vertical=center',
            'contentBanner_right' => 'https://cdn.dribbble.com/userupload/43419848/file/original-a6339a7bbd6958d2c39bd293aecf1cce.png?resize=1024x768&vertical=center',
            'contentBanner_heading' => 'https://cdn.dribbble.com/userupload/15271782/file/original-51a7a734aa67734f25e7aa89a32bbfd9.png?resize=1024x768&vertical=center',
            'email' => 'email@examplemail.com',
            'phone' => '+83924991221',
            'address' => 'initial',
            'pos_code' => 'initial',
            'opentime' => 'initial',
            'facebook_url' => '#',
            'tiktok_url' => '#',
            'map_key' => '#'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
