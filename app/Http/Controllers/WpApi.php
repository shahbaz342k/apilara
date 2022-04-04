<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WpApi extends Controller{

    protected $url='https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products/';

    public function get_all_data(){
        $response = Http::acceptJson()->get($this->url);
        return view('products',compact('response'));
    }


    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Http::acceptJson()->get($this->url.$id);
        $product = json_decode($product->body());


        $cart = session()->get('cart', []);
       //dd($product);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "name" => $product->name,
                "id" => $product->id,
                "image" => $product->images[0]->src,
                "price" => (int)$product->regular_price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }


    public function checkout(Request $request){

        $value = $request->session()->get('cart', 'default');
        // return count($value);
        $item_count = count($value);
        if(Auth::id()){


                $order = new Order();
                $order->order_number = uniqid('ORD-');
                $order->user_id = Auth::id();
                $order->item_count = $item_count;
                $order->grand_total = 20;
                $order->save();



                foreach(  $value as $item ){
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item['id'];
                    $orderItem->image_url = $item['image'];
                    $orderItem->price = $item['price'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->save();
                }
                $request->session()->forget('cart');
               // return  session()->flash('success', 'Checkout');
                return redirect('thank-you')->with('success', 'Thank you for order. OrderID :'.$order->order_number);
        }else{
            return redirect('login');
        }

    }

    public function thank_you(){
        return view('user.thank-you');
    }

    public function order_details($order_id){
        $user_id = Auth::id();
        $orders = Order::with('items')->where('id',$order_id)->where('user_id', $user_id)->get();
        $orderItems = $orders[0]->items;
        $orderid = [$order_id];
        return view('user.order-details',compact('orderItems','orderid'));
    }


    public function admin_orders(){
        $orders = Order::with('items')->get();
        return view('admin.orders.list',compact('orders'));
    }

    public function admin_orders_details($order_id){
        $orders = Order::with('items')->where('id',$order_id)->get();
        $orderItems = $orders[0]->items;
        $orderid = [$order_id];
        return view('admin.orders.details',compact('orderItems','orderid'));
    }

    public function admin_users(){
        $users = User::get();
        return view('admin.users.list',compact('users'));
    }

    public function admin_order_update($order_id, Request $request){
        //return $request->all();
        if( $request->orderid && $request->status ){
            // return $request->orderid;
            Order::where('id',$request->orderid)->update(['status'=>$request->status]);
            return redirect('dashboard/oders')->with('success', 'Order Updated');
        }
        
    }
}



