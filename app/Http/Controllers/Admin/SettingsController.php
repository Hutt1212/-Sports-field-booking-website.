<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PricingSetting;

class SettingsController extends Controller
{
    public function pricing()
    {
        $settings = PricingSetting::first();
        return view('admin.settings.pricing', compact('settings'));
    }

    public function savePricing(Request $request)
    {
        $data = $request->validate([
            'peak_start_time' => 'required|date_format:H:i',
            'peak_surcharge' => 'required|integer|min:0',
        ]);

        $settings = PricingSetting::first();
        if (!$settings) {
            $settings = PricingSetting::create($data);
        } else {
            $settings->update($data);
        }

        // Create notifications for all users about price change
        $users = \App\Models\User::where('role', 'user')->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'type' => 'price_changed',
                'title' => 'Peak Pricing Updated',
                'message' => "Peak pricing has been updated. Peak time starts at {$data['peak_start_time']} with a surcharge of ৳{$data['peak_surcharge']}.",
                'data' => ['peak_start_time' => $data['peak_start_time'], 'peak_surcharge' => $data['peak_surcharge']]
            ]);
        }

        return redirect()->route('admin.settings.pricing')->with('status', 'Pricing settings saved.');
    }
}

