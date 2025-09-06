<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red text-white">
                            {{$error}}
                        </div>
                    @endforeach
                    
                @endif --}}

                <form method="POST" action="{{ route('adminproducts.update', $product) }}" class="m-10" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="my-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <!-- Photo -->
                    <div class="my-4">
                        <x-input-label for="photo" :value="__('Photo')" />
                        <img src="{{Storage::url(($product->photo))}}" alt="" class="w-[50px] h-[50px]">
                        <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" value="{{$product->photo}}" autocomplete="photo" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    
                    <div class="my-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{$product->price}}" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    
                    <div class="my-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option selected value="{{$product->category->id}}">{{$product->category->name}}</option>
                            @foreach ($categories as $category)
                                @if ($category->id === $product->category->id)
                                    @continue
                                @endif
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    
                    <div class="my-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{$product->about}}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Update Product') }}
                        </x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>