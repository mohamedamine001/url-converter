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
                    <!-- Validation Erros messages -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    
                    <!-- Validation Success messages -->
                    <x-validation-success class="mb-4"/>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('logs.source')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('logs.user')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('logs.client_ip')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('logs.country')}}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('logs.user_agent')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <a href="{{ url('/') . '/' . $log->source }}" target="_blank">{{ $log->source }}</a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $log->user->name ?? __('logs.not_logged') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->ip }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->country ?? __('logs.not_detected') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $log->browser }}
                                    </td>
                                </tr>
                                @endforeach
                                @for($fakeLogRow = 0; $fakeLogRow < (5 - $logs->count()); $fakeLogRow++ )
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="py-6"></td>
                                   <td class="py-6"></td>
                                   <td class="py-6"></td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{
                            $logs->links()
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>