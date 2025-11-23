@if (session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 text-sm shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm shadow">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 p-3 rounded-lg bg-yellow-100 text-yellow-700 text-sm shadow">
        {{ session('warning') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-600 text-sm shadow">
        <ul class="list-disc ml-4 space-y-1">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif
