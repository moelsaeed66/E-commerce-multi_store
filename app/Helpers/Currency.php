<?php
  namespace App\Helpers;

  use Illuminate\Support\Facades\Cache;
  use Illuminate\Support\Facades\Session;
  use NumberFormatter;

  class Currency{

      public function __invoke(...$params)
      {
          return static::format(...$params);
      }

      public static function format($amount,$currency=null)
      {
          $base_currency=config('app.currency','USD');
          $formatter= new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
          if($currency==null)
          {
              $currency=Session::get('currency_code',$base_currency);
          }
          if($currency !=$base_currency)
          {
              $rate=Cache::get('currency_rate_'.$currency,1);
              $amount =$amount * $rate;
          }
          return $formatter->formatCurrency($amount,$currency);
      }
  }
