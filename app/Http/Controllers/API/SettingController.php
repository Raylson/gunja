<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\ProductDeliveryRefundDetail;

class SettingController extends Controller
{
    public function index() {
        $settings = site_settings();
        return response([ 'status' => 'success', 'settings' => $settings], 200);
    }

    public function store (Request $request) {
    	$validatedData = $request->validate([
            'title' => 'required|string|max:255',
	        // 'website_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
	        'meta_keywords' => 'required',
	        'meta_description' => 'required',
	        // 'analytics_code' => 'required',
	        'facebook' => 'required',
	        'twitter' => 'required',
	        'whatsapp' => 'required',
	        'instagram' => 'required',
	        'youtube' => 'required',
	        // 'footer_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
	        'footer_address' => 'required',
	        'company_title' => 'required',
	        'company_address' => 'required',
	        'company_phone' => 'required',
	        'company_email' => 'required'
        ]);

        $siteData = $request->except(['deliver_refund_details']);
        $settings = SiteSetting::orderBy('id', 'asc')->first();

        if ($request->hasFile('website_logo')) {
            $filenameWithExt = $request->website_logo->getClientOriginalName();
            $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
            $extension = $request->website_logo->getClientOriginalExtension();
            $featuredImageNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->website_logo->storeAs('public/', $featuredImageNameToStore);
            $siteData['website_logo'] = $featuredImageNameToStore;

            $image_path = "/public"."/".$settings->website_logo;
            \Storage::delete($image_path);
        }
        else
            unset($siteData['website_logo']);

        if ($request->hasFile('footer_logo')) {
            $filenameWithExt = $request->footer_logo->getClientOriginalName();
            $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
            $extension = $request->footer_logo->getClientOriginalExtension();
            $featuredImageNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->footer_logo->storeAs('public/', $featuredImageNameToStore);
            $siteData['footer_logo'] = $featuredImageNameToStore;

            $image_path = "/public"."/".$settings->footer_logo;
            \Storage::delete($image_path);
        }
        else
            unset($siteData['footer_logo']);

        if(!$siteData['analytics_code'])
            $siteData['analytics_code'] = '';

        unset($siteData['id']);
        unset($siteData['created_at']);
        unset($siteData['updated_at']);
        $settings->update($siteData);
        
        \Cache::forget('site-settings');
        \Cache::forget('company-site-settings');
        return response([ 'status' => 'success', 'message' => 'Site setting updated successfully.'], 200);
	}
}
