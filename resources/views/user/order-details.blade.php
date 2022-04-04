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
                    $order = getSingleOrder($orderid[0]);

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
                    </div>
            </div>
            </div>
</x-app-layout>


