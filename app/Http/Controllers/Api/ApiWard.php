<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WardResource;
use Illuminate\Http\Request;

class ApiWard extends Controller
{
    //
    public function findWard($id)
    {
        $wards = $wards = \Kjmtrue\VietnamZone\Models\Ward::whereDistrictId($id)->get();
        if ($wards) {
            return response()->json(['message' => 'Success', 'data' => WardResource::collection($wards)], 200);
        }
    }
}
