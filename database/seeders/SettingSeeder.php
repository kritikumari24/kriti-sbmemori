<?php

namespace Database\Seeders;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'site_name',
                'slug' => 'site_name',
                'value' => 'Common-Setup',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'home_page_title',
                'slug' => 'home_page_title',
                'value' => 'Common-Setup',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'logo',
                'slug' => 'logo',
                'value' => 'laravel-logo.jpeg',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'site_mode',
                'slug' => 'site_mode',
                'value' => '2',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'site_maintenance_message',
                'slug' => 'site_maintenance_message',
                'value' => "('',	'',	'<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\r\n<html><body><p>fghfghfgh<img style=\"width: 477.569px;\" data-filename=\"pexels-pixabay-461428.jpg\" src=\"/storage/files/settings/16256600900.jpeg\"></p',	'text',	1,	NULL,	'2021-07-07 17:44:50',	NULL),",
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'copyright_text',
                'slug' => 'copyright_text',
                'value' => '2022©Deorwine',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'favicon',
                'slug' => 'favicon',
                'value' => 'laravel-favicon.jpeg',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'admin_email',
                'slug' => 'admin_email',
                'value' => 'info@deorwine.com',
                'field_type' => 'text',
                'setting_type' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'support_email',
                'slug' => 'support_email',
                'value' => 'info@deorwine.com',
                'field_type' => 'text',
                'setting_type' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'no_reply_email',
                'slug' => 'no_reply_email',
                'value' => 'info@deorwine.com',
                'field_type' => 'text',
                'setting_type' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'application_from_email_address',
                'slug' => 'application_from_email_address',
                'value' => 'info@deorwine.com',
                'field_type' => 'text',
                'setting_type' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'enable_otp',
                'slug' => 'enable_otp',
                'value' => '1',
                'field_type' => 'text',
                'setting_type' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Address',
                'slug' => 'address',
                'value' => 'fdudshfihsalikfnadsf',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Contact Number',
                'slug' => 'contact_us',
                'value' => '4567891325',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Facebook URL',
                'slug' => 'facebook_url',
                'value' => 'https://www.instagram.com/',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Instagram URL',
                'slug' => 'instagram_url',
                'value' => 'https://www.instagram.com/',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Twitter URL',
                'slug' => 'twitter_url',
                'value' => 'https://www.twitter.com/',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Linkedin URL',
                'slug' => 'linkedin_url',
                'value' => 'https://www.linkedin.com/',
                'field_type' => 'text',
                'setting_type' => '1',
                'created_at' => Carbon::now()
            ],
        ];

        foreach ($data as $value) {
            Setting::firstOrCreate(['slug' => $value['slug']], $value);
        }
    }
}
