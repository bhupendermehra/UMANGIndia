<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'UmangIndia', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Government Schemes & Sarkari Yojana Portal', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Complete information about Indian government schemes, sarkari yojana, eligibility, benefits and application process. Your trusted source for all central and state government welfare schemes.', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'contact@umangindia.com', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '', 'group' => 'general'],

            // SEO
            ['key' => 'meta_title', 'value' => 'UmangIndia - Government Schemes & Sarkari Yojana | Complete Guide', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Complete information about 500+ Indian government schemes. Check eligibility, benefits, application process for PM Kisan, Ayushman Bharat, MGNREGA and more.', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'sarkari yojana, government schemes, pm kisan, ayushman bharat, mgnrega, pm awas yojana, jan dhan yojana, beti bachao beti padhao, sukanya samriddhi, umang india', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => '', 'group' => 'seo'],
            ['key' => 'google_search_console', 'value' => '', 'group' => 'seo'],

            // AdSense
            ['key' => 'adsense_publisher_id', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_header_slot', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_footer_slot', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_sidebar_slot', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_inarticle_slot', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_mobile_slot', 'value' => '', 'group' => 'adsense'],
            ['key' => 'adsense_enabled', 'value' => '0', 'group' => 'adsense'],

            // Social
            ['key' => 'facebook_url', 'value' => '', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => '', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => '', 'group' => 'social'],
            ['key' => 'telegram_url', 'value' => '', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
