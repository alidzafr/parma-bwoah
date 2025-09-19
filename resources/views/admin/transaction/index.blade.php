<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex flex-row w-full justify-between items-center">
                {{ __('Manage Transaction') }}
                <a href="{{route('order.create')}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">Add Transaction</a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                
                {{-- Row Content --}}
                @forelse ($invoices as $invoice)
                <div class="item-card flex flex-row justify-between items-center">
                    <a href="{{route('order.show', $invoice->id)}}">
                        <div>
                            <p class="text-base text-slate-500">
                                Total Transaksi
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$invoice->total_amount}}
                            </h3>
                        </div>
                    </a>
                    
                    <div class="hidden md:flex flex-col">
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{$invoice->created_at}}
                        </h3>
                    </div>
                    {{-- Badge status --}}
                    {{-- {{$invoice->is_paid ? 'approved' : 'pending'}} --}}
                    @if ($invoice->is_paid)
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

                    <div class="hidden md:flex flex-row items-center gap-x-2">
                        <a href="{{route('order.show', $invoice->id)}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">View Details</a>
                    </div>
                </div>
                <hr class="my-3">
                    @empty
                    <p>Transaksi Belum Tersedia</p>
                @endforelse  
                
            </div>
        </div>
    </div>
</x-app-layout>