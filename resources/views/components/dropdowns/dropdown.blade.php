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
                          <img class="w-32 h-32 rounded mr-4 object-contain transform hover:scale-150" :src="(item.image.url.indexOf('products') >=0) ? `/storage/${item.image.url}` : `/storage/products_thumb/${item.image.url}` "  />
                    </figure>
                  </template>
                  <p class="leading-none text-gray-900" x-text="item.name" ></p>
                </div>
              </template>
          </div>
          </template>
          
        </div>
    </div>  

  
</div>