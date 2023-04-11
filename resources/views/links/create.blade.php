<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('dashboard.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('links.store') }}">
                        @csrf
            
                        <!-- Original URL -->
                        <div>
                            <x-label for="original" :value="__('links.original_url')" />
            
                            <x-input id="original" class="block mt-1 w-full" type="url" name="original" :value="old('original')" required autofocus />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('links.generate_shortlink') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>