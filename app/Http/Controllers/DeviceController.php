<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('validate.device.params');
    }
    
    public function register(Request $request)
    {
        $device = Device::where('uid', $request->uid)->first();

        if ($device) {
            return response()->json(['client_token' => $device->client_token]);
        }

        $device = new Device();
        $device->uid = $request->uid;
        $device->app_id = $request->app_id;
        $device->language = $request->language;
        $device->os = $request->os;
        $device->save();

        $client_token = $device->generateClientToken();

        return response()->json(['client_token' => $client_token]);
    }
}
