<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @php 

             $role = get_user_role();

            @endphp
            @if( $role == 'admin')
                <div class="p-10">

                  <div class="dropdown inline-block relative">
                    
                    <ul class="dropdown-menu absolute text-gray-700 pt-1">
                      <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('admin_users') }}">Users</a></li>
                      <li class=""><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('admin_orders') }}">Orders</a></li>
                      
                    </ul>
                  </div>

                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-jet-welcome /> --}}
                    <h2 class="px-4 py-2 font-semibold text-xl text-black-800 text-center leading-tight">All Users</h2>
                   {{--  {{ getAllUserOrders() }} --}}
                    <table class="table-fixed w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 w-20">#ID</th >
                                <th class="px-4 py-2">Name</th >
                                <th class="px-4 py-2">Email</th >
                                <th class="px-4 py-2">Created At</th >
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $users as $user )
                                <tr>
                                    
                                    <td class="border px-4 py-2">{{ $user->id }}</td>
                                    <td class="border px-4 py-2 danger">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->created_at }}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
