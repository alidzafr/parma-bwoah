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
                            Rp 18.000.000
                        </h3>
                    </div>
                    
                    <div>
                        <p class="text-base text-slate-500">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            25 January 2025
                        </h3>
                    </div>
                    {{-- Badge status --}}
                    <span class="py-1 px-3 rounded-full bg-orange-500">
                        <div class="text-white font-bold text sm">
                            Pending
                        </div>
                    </span>

                </div>
                <hr class="my-3">

                <h3 class="text-xl font-bold text-indigo-950">
                    List of items
                </h3>

                <div class="grid grid-cols-4 gap-x-10">
                    
                    <div class="flex flex-col gap-y-5 col-span-2">
                        {{-- Item list --}}
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="" alt ="" class="w-[50px] h-[50px]">
                                <div>
                                    <h3 class="text-xl font-bold text-indigo-950">
                                        Panadol
                                    </h3>
                                    <p class="text-base text-slate-500">
                                        Rp 20.000
                                    </p>
                                </div>
                            </div>
                            <p class="text-base text-slate-500">
                                Vitamin
                            </p>
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="" alt ="" class="w-[50px] h-[50px]">
                                <div>
                                    <h3 class="text-xl font-bold text-indigo-950">
                                        Panadol
                                    </h3>
                                    <p class="text-base text-slate-500">
                                        Rp 20.000
                                    </p>
                                </div>
                            </div>
                            <p class="text-base text-slate-500">
                                Vitamin
                            </p>
                        </div>

                    </div>
                    
                    <div class="flex flex-col gap-y-5 col-span-2">
                        <img src="" alt="" class="w-[300px] bg-red-300 h-[400px]">
                    </div>
                            
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>