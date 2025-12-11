@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif

@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'mb-4 p-3 rounded-lg bg-green-50 border border-green-200']) }}>
        <p class="text-sm text-green-600 font-medium">{{ $status }}</p>
    </div>
@endif