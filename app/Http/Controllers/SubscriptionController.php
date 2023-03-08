<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Purchase;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('validate.subscription.params');
    }

    public function check(Request $request) 
    {
        $device = Device::where('client_token', $request->client_token)->first();

        $purchase = Purchase::where('device_id', $device->id)->latest()->first();

        if (strtotime($purchase->expire_date) < time()) {
            return response()->json([
                'status' => false,
                'expire_date' => $purchase->expire_date,
            ]);
        }
        
        return response()->json([
            'status' => $purchase->status,
            'expire_date' => $purchase->expire_date,
        ]);
    }
}
