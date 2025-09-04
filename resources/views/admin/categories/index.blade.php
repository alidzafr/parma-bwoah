<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex flex-row w-full justify-between items-center">
                {{ __('Manage Categories') }}
                <a href="{{route('admincategories.create')}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">Add Category</a>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                
            @forelse ($categories as $category)
                <div class="item-card flex flex-row justify-between items-center">
                    <img src="{{Storage::url(($category->icon))}}" alt ="" class="w-[50px] h-[50px]">
                    
                    <h3 class="text-xl font-bold text-indigo-950">
                        {{$category->name}}
                    </h3>

                    <div class="flex flex-row items-center gap-x-2">
                        <a href="{{route('admincategories.edit', $category->id)}}" class="py-3 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                        
                        <form method="POST" action="{{ route('admincategories.destroy', $category->id) }}" class="">
                            @csrf
                            @method('DELETE')
                            <button class="py-3 px-5 rounded-full text-white bg-red-700">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                
            @endforelse                

            </div>
        </div>
    </div>
</x-app-layout>