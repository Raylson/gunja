<?php

use App\Models\SiteSetting;

if (! function_exists('image_path')) {
    function image_path($image)
    {
    	return env('APP_URL').'/storage/'.$image;
    }
}

if (! function_exists('thumb_image_path')) {
    function thumb_image_path($image)
    {
      $temp = explode('/', $image);
      $temp1 = $temp[sizeof($temp) - 1];
      $temp[sizeof($temp) - 1] = 'thumbnails';
      $temp[sizeof($temp)] = $temp1;
      $image_path = implode('/', $temp);

    	return env('APP_URL').'/storage/'.$image_path;
    }
}

if (! function_exists('site_settings')) {
    function site_settings()
    {
      $settings = \Cache::remember('site-settings', \Carbon\Carbon::now()->addDays(30), function() {
        return SiteSetting::orderBy('id', 'asc')->first();
      });
      return $settings;
    }
}

if (! function_exists('company_site_settings')) {
    function company_site_settings()
    {
		$companySettings = \Cache::remember('company-site-settings', \Carbon\Carbon::now()->addDays(30), function() {
			return SiteSetting::select('company_title', 'company_address', 'company_phone', 'company_email', 'apply_tax')->orderBy('id', 'asc')->first();
		});
		return $companySettings;
    }
}

if (! function_exists('user_name')) {
    function user_name($user)
    {
		return trim($user->first_name.($user->middle_name != 'null' ? ' '.$user->middle_name : '').($user->last_name != 'null' ? ' '.$user->last_name : ''));
    }
}

if (! function_exists('class_friendly')) {
    function class_friendly($val)
    {
		echo \Str::of($val)->snake();
    }
}