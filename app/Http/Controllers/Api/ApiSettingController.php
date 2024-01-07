<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiSettingController extends Controller
{
    //
    public function getSetting()
    {
        $setting = Setting::where('is_active', 1)->first();
        if ($setting) {
            return response()->json(["message" => "success", "data" => $setting], 200);
        } else {
            return response()->json(["message" => "not found"], 404);
        }
    }
}
