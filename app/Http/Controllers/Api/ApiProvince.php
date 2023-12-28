<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceResource;
use Illuminate\Http\Request;

class ApiProvince extends Controller
{
    //
    public function index()
    {
        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();
        if ($provinces) {
            return response()->json(['message' => 'success', 'data' => ProvinceResource::collection($provinces)], 200);
        }
    }
}
