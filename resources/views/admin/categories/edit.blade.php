<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif -->


                <form method="POST" action="{{ route('admin.category.update', $category) }}" class="m-10" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$category->name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="icon" :value="__('icon')" />
                        <img src="{{Storage::url(($category->icon))}}" alt="" class="w-[50px] h-[50px]">
                        <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" value="{{$category->icon}}" autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Update New Category') }}
                        </x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>