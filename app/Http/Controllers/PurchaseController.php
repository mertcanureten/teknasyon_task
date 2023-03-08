<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Device;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('validate.purchase.params');
    }

    public function purchase(Request $request)
    {
        $device = Device::where('client_token', $request->client_token)->first();
    
        // device bulunamazsa hata döndür
        if (!$device) {
            return response()->json(['error' => 'Invalid client token'], 400);
        }

        $isExistsReceipt = Purchase::where('receipt', $request->receipt)->first();

        if($isExistsReceipt) {
            return response()->json(['error' => 'Receipt has been already used'], 400);
        }
    
        // receipt'i doğrulamak için dış API'ye istek gönder
        $receipt = $request->receipt;
        $isValid = $this->validateReceipt($receipt);
    
        // doğrulama başarılı değilse hata döndür
        if (!$isValid) {
            return response()->json(['error' => 'Invalid receipt'], 400);
        }
    
        // purchase'ı kaydet
        $purchase = new Purchase();
        $purchase->receipt = $receipt;
        $purchase->device_id = $device->id;
    
        // receipt hash'inin son karakteri tek sayıysa, purchase'ın status'ü true
        if (intval(substr($receipt, -1)) % 2 == 1) {
            $purchase->status = true;
            $purchase->expire_date = now()->addYear()->setTimezone('-6')->format('Y-m-d H:i:s');
        }
    
        $purchase->save();
    
        // response döndür
        return response()->json([
            'status' => $purchase->status,
            'expire_date' => $purchase->expire_date,
        ]);
    }
    
    private function validateReceipt($receipt)
    {
        // receipt'in son karakteri tek sayıysa doğrulama başarılı olsun
        return intval(substr($receipt, -1)) % 2 == 1;
    }
    
}
