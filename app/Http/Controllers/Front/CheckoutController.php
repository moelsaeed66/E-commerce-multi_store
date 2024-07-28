<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreate;
use App\Exceptions\InvalidOrderException;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;


class CheckoutController extends Controller
{
    //order controller
    public function create(CartRepository $cart)
    {
        if($cart->get()->count() ==0)
        {
            throw new InvalidOrderException('Cart Is Empty');
//            return redirect()->route('home');
        }

        return view('front.checkout',[
            'cart'=>$cart,
            'countries'=>Countries::getNames(),
        ]);
    }

    public function store(CartRepository $cart,Request $request)
    {
//        $request->validate([
//            'addr.billing.first_name'=>['required','string','max:255']
//
//        ]);
        $items=$cart->get()->groupBy('product.store_id')->all();
//        dd($items);
//        dd(Request::get('addr'));


        DB::beginTransaction();

        try {
            foreach ($items as $store_id =>$cart_items)
            {
//                dd($cart_items);
                $order=Order::create([
                    'store_id'=>$store_id,
                    'user_id'=>Auth::id(),
                    'payment_method'=>'cod'
                ]);
                foreach ($cart_items as $item)
                {
//                    dd($item);
                    OrderItem::create([
                        'order_id'=>$order->id,
                        'product_id'=>$item->product_id,
                        'product_name'=>$item->product->name,
                        'price'=>$item->product->price,
                        'quantity'=>$item->quantity
                    ]);
                }
//                dd($request);

                foreach ($request->post('addr') as $type => $address)
                {

                    $address['type']=$type;
//                    $address['order_id']=$order->id;
//                    $address=(object)$address;
//                   dd($address);
                    $order->addresses()->create($address);
//                    OrderAddress::create($address);
                }
            }
            DB::commit();
//            event('order.created',$order);
            event(new OrderCreate($order));
        }catch (\Throwable $e)
        {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('orders.payments.create',$order->id);


    }

}
