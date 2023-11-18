<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $coupon;
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
    public function index()
    {
        //
        $coupons = $this->coupon->latest()->paginate(10);
        return view('Admin.Coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.Coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $newCoupon = $this->coupon;
            $newCoupon->code = $request->code;
            $newCoupon->status = $request->status;
            $newCoupon->discount = $request->discount;
            $newCoupon->value = $request->value;
            $newCoupon->end_time = $request->end_time;
            $newCoupon->description = $request->description;
            $newCoupon->save();
            if ($newCoupon->save()) {
                Alert::success('Thêm danh mục thành công');
                return redirect()->route('admin.coupon.index');
            } else {
                Alert::error('Đã sảy ra một số vấn đề');
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = $this->coupon::find($id);
        return view('Admin.Coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if ($id) {
            $updateCoupon = $this->coupon::find($id);
            $updateCoupon->code = $request->code;
            $updateCoupon->status = $request->status;
            $updateCoupon->discount = $request->discount;
            $updateCoupon->value = $request->value;
            $updateCoupon->end_time = $request->end_time;
            $updateCoupon->description = $request->description;
            $updateCoupon->save();
            if ($updateCoupon->save()) {
                Alert::success('Thêm danh mục thành công');
                return redirect()->route('admin.coupon.index');
            } else {
                Alert::error('Đã sảy ra một số vấn đề');
                return back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if ($id) {
            $coupon = $this->coupon::find($id);
            if ($coupon->delete()) {
                Alert::success('Đã xoá mã');
                return back();
            }
        }
    }
}
