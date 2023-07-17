<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UxuiUserCreateUserDefaultSeeder::class,
            UxuiUserAksesSeeder::class,
            UxuiSettingAppVariabelSeeder::class,
            RefJadwalPhitungSeeder::class
        ]);
    }
}