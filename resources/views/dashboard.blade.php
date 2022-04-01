<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                <h2 class="px-4 py-2 font-semibold text-xl text-black-800 text-center leading-tight">My Orders</h2>
               {{--  {{ getAllUserOrders() }} --}}
                <table class="table-fixed w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 w-20">#Order Numer</th >
                            <th class="px-4 py-2">Status</th >
                            <th class="px-4 py-2">Total</th >
                            <th class="px-4 py-2">Created At</th >
                            <th class="px-4 py-2">Action</th >
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( getAllUserOrders() as $order )
                            <tr>
                                <td class="border px-4 py-2">{{ $order->order_number }}</td>
                                <td class="border px-4 py-2">{{ $order->status }}</td>
                                <td class="border px-4 py-2">{{ $order->grand_total }}</td>
                                <td class="border px-4 py-2">{{ $order->created_at }}</td>
                                <td class="border px-4 py-2">
                                <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">Edit</button>
                                    
                        </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>
