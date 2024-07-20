<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'currency_code'=>['required','string','size:3']
        ]);
        $currency_code=$request->input('currency_code');
        $cacheKey='currency_rate_'.$currency_code;
        $rate=Cache::get('currency_rates',[]);
        $base_currency=config('app.currency');
        if(!$rate)
        {
//            $converter=App::make('currency_converter');
            $converter=app('currency_converter');
            $rate=$converter->convert($base_currency,$currency_code);
//            $rates[$currency_code]=$rate;
            Cache::put($cacheKey,$rate,now()->addMinutes(50));
        }
        Session::put('currency_code',$currency_code);



//        Session::put('currency_rate',$rate);
        return redirect()->back();
    }
}
