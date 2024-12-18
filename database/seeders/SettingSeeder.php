<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        DB::table('settings')->insert([
            [
                'option_name' => 'site_name',
                'option_value' => 'Kids Minnie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_url',
                'option_value' => 'http://kidsminnie.test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'home_url',
                'option_value' => 'http://kidsminnie.test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'admin_url',
                'option_value' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_tagline',
                'option_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_description',
                'option_value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, aspernatur!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'users_can_register',
                'option_value' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'admin_email',
                'option_value' => 'admin@kidsminnie.test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'start_of_week',
                'option_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'comments_notify',
                'option_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'mailserver_url',
                'option_value' => 'smtp.example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'mailserver_login',
                'option_value' => 'admin@kidsminnie.test',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'mailserver_pass',
                'option_value' => 'password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'mailserver_port',
                'option_value' => '110',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'default_category',
                'option_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'per_page',
                'option_value' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'date_format',
                'option_value' => 'F j, Y',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'time_format',
                'option_value' => 'g:i a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'links_updated_date_format',
                'option_value' => 'F j, Y g:i a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'html_type',
                'option_value' => 'text/html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'default_role',
                'option_value' => 'subscriber',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'thumbnail_size_w',
                'option_value' => '150',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'thumbnail_size_h',
                'option_value' => '150',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'medium_size_w',
                'option_value' => '300',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'medium_size_h',
                'option_value' => '300',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'large_size_w',
                'option_value' => '1024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'large_size_h',
                'option_value' => '1024',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_logo',
                'option_value' => 'media/km-logo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_favicon',
                'option_value' => 'media/logo-small.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'page_on_front',
                'option_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}