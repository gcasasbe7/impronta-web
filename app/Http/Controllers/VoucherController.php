<?php

namespace App\Http\Controllers;

use App\User;
use App\Voucher;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{

    public function getVouchers(){
        $start = microtime(true);

        $actual_date = Carbon::now()->addHours(2);

        $vouchers = Voucher::whereDate('dead_date','>', $actual_date->subDay())->where('is_used','=',0)->with('user')->get();

        $end = microtime(true);

        info("GETTING HK VOUCHERS:" . ($end - $start));

        return $vouchers;
    }

    public function getUserVouchers(){
        $actual_date = Carbon::now()->addHours(2);

        $vouchers = Voucher::where('user_id','=',Auth::user()->id)->whereDate('dead_date','>', $actual_date->subDay())->where('is_used','=',0)->with('user')->get();

        $data = array(
            'vouchers' => $vouchers
        );
        $response = response()->json($data,200);

        return $response;
    }



    public function generateVoucher(Request $request){
        $start = microtime(true);

        $points = $request->input('points');

        $dead_date = Carbon::now()->addHours(2)->addDays(10);

        $code = $this->generateVoucherCode();

        $voucher = new Voucher;
        $voucher->code = $code;
        $voucher->points = $points;
        $voucher->dead_date = $dead_date;
        $voucher->is_used = false;
        $voucher->user_id = Auth::user()->id;

        $voucher->save();

        $data = array(
            'voucherCode' => $code
        );
        $response = response()->json($data,200);

        $end = microtime(true);

        info("GETTING VOUCHER GENERATION:" . ($end - $start));
        return $response;
    }

    public function generateVoucherCode(){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        $condition = true;

        while($condition) {
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[mt_rand(0, $max)];
            }

            $condition = Voucher::where('code', '=', $code)->count() > 0;
        }

        return $code;
    }

    public function validateVoucher(Request $request){
        $start = microtime(true);
        $code = $request->input('code');

        $voucher = Voucher::where("code",$code)->first();

        $actual_date = Carbon::now()->addHours(2);
        $dead_date = Carbon::parse($voucher->dead_date);

        $user = User::find($voucher->user_id);


        if($dead_date->gt($actual_date) and $user->points >= $voucher->points){

            $user->points = $user->points - $voucher->points;
            $user->save();
            $voucher->is_used = true;
            $voucher->save();

            $data = array(
                'result' => true
            );

        }else{
            $data = array(
                'result' => false
            );
        }

        $response = response()->json($data,200);

        $end = microtime(true);

        info("GETTING VOUCHER VALIDATION:" . ($end - $start));

        return $response;
    }
}
