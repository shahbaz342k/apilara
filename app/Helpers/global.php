<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
function getAllUserOrders(){
    $user_id = Auth::id();
    $orders = Order::with('items')->where('user_id', $user_id)->get();
    return $orders;

}

function getSingleOrder($order_id){
    $user_id = Auth::id();
    $order = Order::where('id', $order_id)->where('user_id', $user_id)->first();
    return $order;

}

function get_user_role(){
    $role = Auth::user()->roles->pluck('name');
    return $role[0];
}

function getSingleOrderAdmin($order_id){
    $order = Order::where('id', $order_id)->first();
    return $order;

}
