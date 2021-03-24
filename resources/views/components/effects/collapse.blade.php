@props(['selected'=>'1'])
<div class="relative " x-data="{selected: {{$selected}} }">
    <div  @click="selected !== 1 ? selected = 1 : selected = null">
        {{ $header }}
    </div>

    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
        {{ $slot }}
    </div>

</div>
