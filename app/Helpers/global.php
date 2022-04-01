<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
function getAllUserOrders(){
    $user_id = Auth::id();
    $orders = Order::with('items')->where('user_id', $user_id)->get();
    return $orders;

}