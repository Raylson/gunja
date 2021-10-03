<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSetting::create([
        	'title' => 'ABC Pvt. Ltd.',
			'website_logo' => 'logo.svg',
			'meta_keywords' => 'best it company',
			'meta_description' => 'Best IT company',
			'analytics_code' => '',
			'facebook' => 'https://www.facebook.com/',
			'twitter' => 'https://twitter.com/',
			'whatsapp' => '#',
			'instagram' => 'https://www.instagram.com/',
			'youtube' => 'https://www.youtube.com/channel/',
			'footer_logo' => 'logo.svg',
			'footer_desc' => '<h1>Best IT company in Nepal.</h1>',
			'footer_address' => '<ul class="address" itemprop="address" itemscope="" itemtype="https://schema.org/PostalAddress"><li><i class="fas fa-map-marker-alt"></i> <span itemprop="streetAddress">Newroad</span>, <span itemprop="addressLocality">Kathmandu, Nepal</span> <span itemprop="postalCode">44600</span></li><li><i class="fas fa-phone"></i> <span itemprop="telephone"></span></li><li><i class="fas fa-envelope"></i> <span itemprop="email">info@abc.com.np</span></li><li><i class="fas fa-registered"></i> Reg No: </li></ul>',
			'footer_help' => '<div class="phone d-flex align-items-center"><div><i class="fas fa-headset fa-4x text-success"></i></div><div><p itemprop="telephone"><span>NEED HELP?</span>+977  <br>+977</p></div></div>',
			'footer_info_news' => '',
			'footer_payments' => '',
			'footer_appstore' => ''
        ]);
    }
}
