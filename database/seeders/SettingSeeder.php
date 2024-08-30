<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Setting::query()->create([
            'logo' => "logo.png",
            "store_name" => "Store name",
            'banner' => "https://images.pexels.com/photos/27722068/pexels-photo-27722068/free-photo-of-sometimes-it-s-the-one-with-the-most-beautiful-view.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
        ]);
    }
}
