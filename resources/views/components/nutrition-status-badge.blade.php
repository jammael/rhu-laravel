@props(['status' => 'normal', 'showText' => true])

@if ($status === 'normal')
    <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">
        @if($showText) 🟢 Normal @endif
    </span>
@elseif ($status === 'underweight')
    <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">
        @if($showText) 🟡 Underweight @endif
    </span>
@elseif ($status === 'severely_underweight')
    <span class="inline-block px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">
        @if($showText) 🔴 Severely Underweight @endif
    </span>
@endif
