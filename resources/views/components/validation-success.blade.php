@if(session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="success">
        <p class="mt-3 text-sm text-green-600">
            {{ session()->get('success') }}
        </p>
    </div>
@endif
