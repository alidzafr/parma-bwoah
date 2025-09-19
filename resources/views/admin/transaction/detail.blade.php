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
                <div class="item-card flex gap-y-3 flex-col md:flex-row justify-between md:items-center">
                    <div>
                        <p class="text-base text-slate-500">
                            Total Transaksi
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{$invoice->total_amount}}
                        </h3>
                    </div>
                    
                    <div>
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{$invoice->created_at}}
                        </h3>
                    </div>
                    
                    {{-- Badge status --}}
                    {{-- {{$transaction->is_paid ? 'approved' : 'pending'}} --}}
                    @if ($invoice->is_paid)
                    <span class="py-1 px-3 w-fit rounded-full bg-green-500">
                        <div class="text-white font-bold text sm">
                            Success
                        </div>
                    </span>
                    @else
                    <span class="py-1 px-3 w-fit rounded-full bg-orange-500">
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

                <div class="grid-cols-1 md:grid-cols-4 grid gap-x-10">
                    
                    <div class="flex flex-col gap-y-5 col-span-2">
                        {{-- Item list --}}
                        @forelse ($invoice->purchasedProducts as $purchased_product)
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{Storage::url($purchased_product->product->photo)}}" alt ="" class="w-[50px] h-[50px]">
                                <div>
                                    <h3 class="text-xl font-bold text-indigo-950">
                                        {{$purchased_product->product->name}}
                                    </h3>
                                    <p class="text-base text-slate-500">
                                        {{$purchased_product->product->category->name}}
                                    </p>
                                </div>
                            </div>
                            <p>
                                x{{$purchased_product->quantity}}
                            </p>
                            <p class="text-base text-indigo-950">
                                Rp {{$purchased_product->price}}
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
                                {{{$invoice->address}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$invoice->city}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$invoice->post_code}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{{$invoice->phone_number}}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col items-start">
                            <p class="text-base text-slate-500">
                                Note
                            </p>
                            <h3 class="text-lg font-bold text-indigo-950">
                                {{$invoice->notes}}
                            </h3>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-y-5 col-span-2 items-end">
                        <h3 class="text-xl font-bold text-indigo-950">
                            Proof of Payment:
                        </h3>
                        <img src="{{Storage::url($invoice->proof)}}" alt="{{Storage::url($invoice->proof)}}" class="w-[300px]h-[400px]">
                    </div>
                            
                </div>

                <hr class="my-3">

                @role('owner')
                @if (!$invoice->is_paid)
                <form action="{{route('order.update', $invoice->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="font-bold  py-3 px-5 rounded-full text-white bg-indigo-700">
                        Approve Order
                    </button>
                </form>
                @endif
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