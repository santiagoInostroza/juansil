@props(['id' => 'search', 'value' => 0, 'placeholder' => 'Buscar...','items'])

<div  wire:ignore class="font-sans leading-normal tracking-normal bg-grey-100">    
    <div id="{{$id}}"  x-data="dropdown()" x-init=" id='{{$id}}';value= {{$value}}; items= {{ $items }}; setName();" class="mx-auto " @click.away="close()">    
        <div>
            <x-jet-input 
                id="searchField_{{$id}}"
                x-model="filter"
                x-ref="searchField" 
                {{-- x-on:keydown.window.prevent.slash="$refs.searchField.focus()" --}}
                @keydown="openIf"
                @keydown.escape="close()"
                @keydown.tab="selectOption()"
                @click="open()"
                @focus="open()"
                @keydown.arrow-up.prevent="focusPrevOption()"
                @keydown.arrow-down.prevent="focusNextOption()"
                @keydown.enter.stop.prevent="selectOption()"
                placeholder="{{$placeholder}}" type="search"
                class="block w-full h-full px-4 py-3 font-bold text-gray-700  rounded-lg focus:outline-none  focus:shadow" 
            />
        </div>
     

        <input {!! $attributes->merge(['class' => '']) !!} type="hidden" id="buscador_{{ $id }}" onchange="setName()"  />
       
        <div class="shadow absolute w-full z-50 bg-white overflow-auto max-h-96" :class=" show ? '':'hidden'" id="opcion_{{ $id }}">
          <template x-if="filteredOptions().length > 0">
            <div>          
              <template x-for="(item,index) in filteredOptions()" :key="item">
                <div  @click="onOptionClick(index)" :class="classOption(item.id, index)" :aria-selected="focusedOptionIndex === index" :id="'{{$id}}_opcion_' + index" x-ref="item.name" >       
                  <template x-if="item.image">
                      <figure>
                        @if ( Storage::exists(`products_thumb/${item.image.url}` ))
                          <img class="w-10 h-10 rounded-full mr-4 object-contain" :src="`/storage/products_thumb/${item.image.url}`" />
                        @else
                          <img class="w-10 h-10 rounded-full mr-4 object-contain" :src="`/storage/${item.image.url}`" />
                        @endif
                    </figure>
                  </template>
                  <p class="leading-none text-gray-900" x-text="item.name" ></p>
                </div>
              </template>
          </div>
          </template>
          {{-- @if (isset($slot))
            <div :class="classOption(0, 0)" :aria-selected="focusedOptionIndex === 0" :id="'{{$id}}_opcion_' + 0" x-ref="nuevo" >
              <template x-if="filteredOptions().length==0">
              
                  <p class="leading-none text-gray-900"  >
                    {{$slot}}
                  </p>
              
              </template>
            </div>
          @endif --}}
          
        </div>
    </div>  

  
</div>