<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex flex-row w-full justify-between items-center">
                {{ __('Manage Product') }}
                <a href="{{route('admin.product.create')}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">Add Product</a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                
            @forelse ($products as $product)
                <div class="item-card flex flex-row justify-between items-center">
                    
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url(($product->photo))}}" alt ="" class="w-[50px] h-[50px]">
                        <div>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{$product->name}}
                            </h3>
                            <p class="text-base text-slate-500">
                                Rp {{$product->price}}
                            </p>
                        </div>
                        <p class="text-base text-slate-500">
                            {{$product->category->name}}
                        </p>
                    </div>

                    <div class="flex flex-row items-center gap-x-2">
                        <a href="{{route('admin.product.edit', $product->id)}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                        
                        <form method="POST" action="{{ route('admin.product.destroy', $product->id) }}" class="">
                            @csrf
                            @method('DELETE')
                            <button class="py-3 px-5 rounded-full text-white bg-red-700" onclick="return confirm('Are you sure want to delete?');">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>
                    Belum ada produk.
                </p>
            @endforelse                

            </div>
        </div>
    </div>
</x-app-layout>