@props(['position_x' => 'left', 'position_y' => 'top'])
@php
    if($position_x == 'right' ){
        $position_x = "-translate-x-1/2";
    }else{
        $position_x = " -translate-x-full";
    }

    if($position_y == 'top' ){
        $position_y = "-translate-y-full";
    }else{
        $position_y = "";
    }

@endphp
<div x-data="{ tooltip: false }" class="relative z-10 inline-flex">
    <div class="p-1" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
        {{$slot}}
    </div>
    <div class="relative hidden" x-cloak x-show.transition.origin.top="tooltip" :class="{'hidden':!tooltip}">
        <div {{ $attributes->merge(['class' => 'absolute top-0 z-10 w-max-content p-3 -mt-2 text-sm leading-tight text-cool-gray-700 font-bold transform  ' . $position_x . ' ' . $position_y . ' bg-gray-200 rounded-lg shadow-lg']) }} class="" >
        {{-- <div {{ $attributes->merge(['class' => 'absolute top-0 z-10 w-max-content p-3 -mt-2 text-sm leading-tight text-cool-gray-700 font-bold transform  bg-gray-200 rounded-lg shadow-lg mb-10 right-0']) }} class="" > --}}
            {{$tooltip}}
        </div>
        <svg class="absolute z-10 w-6 h-6 text-gray-200 transform -translate-x-12 -translate-y-3 fill-current stroke-current"
            width="8" height="8">
            <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
        </svg>
    </div>
</div>
