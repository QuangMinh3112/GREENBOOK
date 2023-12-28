<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use Illuminate\Http\Request;

class ApiDistrict extends Controller
{
    //
    public function findDistrict($id)
    {
        $districts = \Kjmtrue\VietnamZone\Models\District::whereProvinceId($id)->get();
        if ($districts) {
            return response()->json(['message' => 'Success', 'data' => DistrictResource::collection($districts)], 200);
        }
    }
}
