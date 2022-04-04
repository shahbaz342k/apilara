@php 

$role = get_user_role();

@endphp
@if( $role == 'admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
           
            <div class="mt-5 md:mt-0 md:col-span-2">
                @php 
                    $order = getSingleOrderAdmin($orderid[0]);

                @endphp
                <h2 class="px-4 py-2 font-semibold text-xl text-black-800 text-center leading-tight">#Order Number - {{ $order->order_number }}</h2>
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-6">
                           {{--  @foreach($orderItems as $order_item)
                                {{ $order_item->product_id }}
                            @endforeach --}}
                            <table class="table-fixed w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 w-20">#Product</th >
                                        <th class="px-4 py-2">Image</th >
                                        <th class="px-4 py-2">Price</th >
                                        <th class="px-4 py-2">Quantity</th >
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $orderItems as $order_item )
                                        <tr>
                                            
                                            <td class="border px-4 py-2">{{ $order_item->product_id }}</td>
                                            <td class="border px-4 py-2 danger">
                                                <img src="{{ $order_item->image_url }}" width="100" /> 
                                                
                                            </td>
                                            <td class="border px-4 py-2">{{ $order_item->price }}</td>
                                            <td class="border px-4 py-2">{{ $order_item->quantity }}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h3 class="p-2 col-span-6 text-right">Total Price: 123 </h3>
                        </div>
                        <div class="p-2 col-span-6"> 
                            <h3 class="">Status </h3>
                            @php
                                $selected = $order->status;

                            @endphp
                            <form method="post" >
                                @csrf
                                <select name="status" class="order_status_update" id="order_id">
                                     <option value="pending" {{ $order->status =='pending' ? 'selected' : ''}}>Pending</option>
                                     <option value="processing" {{ $order->status =='processing' ? 'selected' : ''}}>Processing</option>
                                     <option value="completed" {{ $order->status =='completed' ? 'selected' : ''}}>Completed</option>
                                     <option value="decline" {{ $order->status =='decline' ? 'selected' : ''}}>Cancelled</option>
                                </select>
                            </form>
                             
                        </div>
                         
                    </div>
            </div>
            </div>
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(".order_status_update").change(function (e) {
        e.preventDefault();

        var ele = $(this);
        
        
        let select_value = $('#order_id :selected').val();
        
        jQuery.ajax({
            url: '{{ route("admin_order_update", [$orderid[0]]) }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                orderid: '{{ $orderid[0] }}',
                status: select_value
            },
            success: function (response) {
                if( response == true ){
                    window.location.href = '{{route('admin_orders')}}'
                }
               
               // console.log(response)
            }
        });
    });

    
</script>

@endif