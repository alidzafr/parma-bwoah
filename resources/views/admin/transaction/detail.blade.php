<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex flex-row w-full justify-between items-center">
                {{ __('Detail') }}
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Row Content --}}
                <div class="item-card flex flex-row justify-between items-center">
                    <div>
                        <p class="text-base text-slate-500">
                            Total Transaksi
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{$productTransaction->total_amount}}
                        </h3>
                    </div>
                    
                    <div>
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{$productTransaction->created_at}}
                        </h3>
                    </div>
                    
                    {{-- Badge status --}}
                    {{-- {{$transaction->is_paid ? 'approved' : 'pending'}} --}}
                    @if ($productTransaction->is_paid)
                    <span class="py-1 px-3 rounded-full bg-green-500">
                        <div class="text-white font-bold text sm">
                            Success
                        </div>
                    </span>
                    @else
                    <span class="py-1 px-3 rounded-full bg-orange-500">
                        <div class="text-white font-bold text sm">
                            Pending
                        </div>
                    </span>
                    @endif

                </div>
                <hr class="my-3">

                <h3 class="text-xl font-bold text-indigo-950">
                    List of items
                </h3>

                <div class="grid grid-cols-4 gap-x-10">
                    
                    <div class="flex flex-col gap-y-5 col-span-2">
                        {{-- Item list --}}
                        @forelse ($productTransaction->transactionDetails as $purchased_item)
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{Storage::url($purchased_item->product->photo)}}" alt ="" class="w-[50px] h-[50px]">
                                <div>
                                    <h3 class="text-xl font-bold text-indigo-950">
                                        {{$purchased_item->product->name}}
                                    </h3>
                                    <p class="text-base text-slate-500">
                                        {{$purchased_item->price}}
                                    </p>
                                </div>
                            </div>
                            <p class="text-base text-slate-500">
                                {{$purchased_item->product->category->name}}
                            </p>
                        </div>
                        @empty
                            
                        @endforelse

                        <h3 class="text-xl font-bold text-indigo-950">
                            Detail of Delivery
                        </h3>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Address
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$productTransaction->address}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$productTransaction->city}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$productTransaction->post_code}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$productTransaction->phone_number}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Note
                            </p>
                            <h3 class="text-lg font-bold text-indigo-950">
                                {{$productTransaction->notes}}
                            </h3>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-y-5 col-span-2 items-end">
                        <h3 class="text-xl font-bold text-indigo-950">
                            Proof of Payment:
                        </h3>
                        <img src="" alt="{{Storage::url($productTransaction->proof)}}" class="w-[300px] bg-red-300 h-[400px]">
                    </div>
                            
                </div>

                <hr class="my-3">

                @role('owner')
                <form action="{{route('product_transaction.update', 1)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="font-bold  py-3 px-5 rounded-full text-white bg-indigo-700">
                        Approve Order
                    </button>
                </form>
                @endrole

                @role('buyer')
                <a href="#" class="w-fit font-bold py-3 px-5 rounded-full text-white bg-indigo-700">
                    Contact Admin
                </a>
                @endrole
                
            </div>
        </div>
    </div>
</x-app-layout>