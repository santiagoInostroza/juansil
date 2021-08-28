<div>
   <div class="">
   
   </div>
   <div  wire:ignore >
      <div class="mt-10">
      
         {{-- BANNER --}}
         {{-- <div
            class="max-h-full b-8 ta-gallery ta-gallery-aspect-instagram hidden"
            style="height: max-content"
            x-data="taGallery()"
            x-init="init()"
            data-start="0"
            data-autoplay="true"
            data-interval="5000"
            data-timing="ease-in-out"
            data-duration="0.3s"
         >
   
            <div class="rounded-lg ta-gallery-element ta-gallery-anim-swing" x-cloak style="height: max-content">
               <figure>
                  <img
                        src="{{url('images/portada/Juansil1.png')}}"
                        alt="Example Image"
                        class=""
                        loading="lazy"
                        x-ref="size "
                  />
                  
               </figure>
            </div>
            <div class="rounded-lg ta-gallery-element ta-gallery-anim-rotate" x-cloak style="height: max-content">
               <figure>
                  <img
                        src="{{url('images/portada/Juansil2.png')}}"
                        alt="Example Image"
                        class=""
                        loading="lazy"
                        x-ref="height"
                  />
                  
               </figure>
            </div>
         
         
         
            <button
               type="button"
               class="flex items-center justify-center w-10 h-10 text-white bg-black bg-opacity-75 border-2 border-white rounded-full shadow-xl ta-gallery-button -left-5 sm:left-2 focus:ring focus:ring-primary"
               x-on:click="previous()"
               x-show="loaded"
            >
               <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                  <path
                        d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"
                  ></path>
               </svg>
            </button>
            <button
               type="button"
               class="flex items-center justify-center w-10 h-10 text-white bg-black bg-opacity-75 border-2 border-white rounded-full shadow-xl ta-gallery-button -right-5 sm:right-2 focus:ring focus:ring-primary"
               x-on:click="next()"
               x-show="loaded"
            >
               <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                  <path
                        d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"
                  ></path>
               </svg>
            </button>
         
         </div> --}}

      {{-- BANNER OPCION 2 --}}
      <div class="hidden md:block">
         <div class="splide splideBanner ">
            <div class="splide__track">
               <ul class="splide__list">
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_leches_xl.png')}}">
                     </div>
                  </li>
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_paltas_xl.png')}}">
                     </div>
                  </li>
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_registrarse_xl.png')}}">
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   
      <div class="block md:hidden">
         <div class="splide splideBanner">
            <div class="splide__track">
         
               <ul class="splide__list">
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_leches_lg.png')}}">
                     </div>
                  </li>
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_paltas_lg.png')}}">
                     </div>
                  </li>
                  <li class="splide__slide">
                     <div class="splide__slide__container">
                        <img data-splide-lazy="{{url('images/portada/banner_registrarse_lg.png')}}">
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   

      {{-- PRODUCTOS POR CATEGORIA --}}
      <div class="px-5 sm:px-20 mt-10" >
         <h2 class="text-3xl font-hairline text-red-500 sm:text-5xl"> Mira <span class="block sm:inline-block mb-5 -mt-5 font-sans font-bold text-5xl sm:mb-0 sm:mt-0">Por categoria</span> </h2>
      </div>
      <div>
         @foreach ($categories as $categoria)
            @if ( count($categoria->products) )
               <a href="{{route('products.category',$categoria)}}">
                  <h2 class="p-5 text-2xl font-bold text-gray-600 text-center bg-gray-100">{{$categoria->name}}</h2>
               </a>
               <div class="splide splideIndex"> 
                  <div class="splide__track">
                     <ul class="splide__list">
                        @foreach ($categoria->products as $product)
                           <li class="splide__slide border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
                              <a href="{{route('products.show',$product)}}">
                                 <div class="w-full">
                                    @if ($product->image)


                                    <figure class="splide__slide__container">
                                       @if ( Storage::exists('products_thumb/' .$product->image->url))
                                          <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url('products_thumb/' . $product->image->url) }}" src="{{ Storage::url('products_thumb/' . $product->image->url) }}">
                                       @else
                                          <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url($product->image->url) }}" src="{{ Storage::url($product->image->url) }}">
                                       @endif
                                    </figure>



                                         
                                    @endif
                                    
                                    <div class="text-gray-600 w-max-content m-auto max-w-full">
                                          <div class="font-bold">
                                             {{$product->brand->name}}
                                          </div>
                     
                                       <div class="max-w-full">
                                             {{$product->name}}
                                          </div>                           
                                    </div>
                                 </div>
                              </a>
                              <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                              
                                 @if (isset($product->salePrices))
                                    @foreach ($product->salePrices as $price)
                                          @if ( count($product->salePrices)==1)
                                             <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                          @else
                                             @if ($price->quantity == 1)
                                             <div class="text-sm grid grid-cols-2">
                                                <div class="text-right">{{ $price->quantity }} x </div>
                                                <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                             </div>
                                                
                                             @else
                                                <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                                      <div class="">
                                                         {{ $price->quantity }} x  ${{ number_format($price->total_price, 0,',','.') }}
                                                      </div>
                                                      <span class="text-left bg-red-600 text-sm  sm:text-lg  px-1 mx-1  rounded text-white w-max-content" style="padding-top: 1px">
                                                         ${{ number_format($price->price, 0,',','.') }} c/u
                                                      </span>
                                                </div>
                                                
                                             @endif
                                             
                                          @endif
                                    @endforeach
                                 @endif
                        
                              </div>
                              
                        
                              @if ($product->stock>0)
                                 <div class="text-center mt-4 relative" >
                                       <div class="@if (session()->has('carrito.'.$product->id)) hidden @endif agregar_{{$product->id}}">
                                          <x-jet-secondary-button onclick="return addToCart({{ $product->id }});"> 
                                             <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                             Agregar
                                          </x-jet-secondary-button>
                                       </div>
                                       <div class="w-max-content m-auto @if (!session()->has('carrito.'.$product->id)) hidden @endif agregado_{{$product->id}}">
                                          <i class="fas fa-shopping-cart text-green-500"></i>
                                          <label for="cantidad_product_{{$product->id}}">
                                             <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product->id}}" value="{{ (isset(session('carrito')[$product->id])) ? session('carrito')[$product->id]['cantidad']:'1' }}"
                                                   wire:ignore 
                                                   onchange="return listaSetCantidad({{ $product->id }}, {{ $product->stock }})"  
                                                   id='cantidad_product_{{ $product->id }}'  
                                                   data-pid="{{ $product->id }}"
                                             > 
                                          </label>
                                          <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $product->id }})" data-pid="{{$product->id}}">-</x-jet-secondary-button>
                                          
                                          <x-jet-secondary-button onclick="return listaAumentaCantidad({{ $product->id }}, {{ $product->stock }})" data-pid="{{$product->id}}">+</x-jet-secondary-button>
                                       </div>
                                 </div>
                              @else
                                 <div class="text-center mt-4">
                                    <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> Agotado</div>
                                 </div>
                              @endif                    
                           </li>    
                        @endforeach
                     </ul>
                  </div>
               </div>
            @endif
         @endforeach
      </div>

               

         
      <div class="flex justify-end bg-gradient-to-r from-white to-gray-200  pb-20  mb-10 sm:p-20">
         <div class="px-20 my-20" >
            <h2 class="text-3xl font-hairline text-red-500 sm:text-5xl">Explora nuestros <span class="inline-block mb-5 -mt-5 font-sans text-5xl font-bold sm:mb-0 sm:mt-0">productos</span></h2>
            <p class="max-w-md text-gray-600">
               <span class="font-extrabold"></span>Somos un joven emprendimiento y lucharemos por hacer crecer nuestra variedad de productos para que no te falte nada.
            </p>
            
         
            {{-- <div class="flex items-center justify-between max-w-xs gap-1 p-2 my-8 sm:gap-6 sm:max-w-md sm:w-max-content">
               <a href="{{route('products.lista')}}">
                  <img class="object-cover w-20 h-20 bg-gray-800 rounded-full sm:h-32 sm:w-32 " src="{{url('images/min/leche_min.jpg')}}" alt="">
                  <p class="p-2 text-sm font-bold text-center text-gray-600" >Lacteos</p>
               </a>
               <a href="{{route('products.lista')}}">
                  <img class="object-cover w-20 h-20 bg-gray-800 rounded-full sm:h-32 sm:w-32 " src="{{url('images/min/abarrotes3_min.jpeg')}}" alt="">
                  <p class="p-2 text-sm font-bold text-center text-gray-600" >Abarrotes</p>
               </a>
               <a href="{{route('products.lista')}}">
                  <img class="object-cover w-20 h-20 bg-gray-800 rounded-full sm:h-32 sm:w-32 " src="{{url('images/min/abarrotes_min.jpg')}}" alt="">
                  <p class="p-2 text-sm font-bold text-center text-gray-600" >Todo</p>         
               </a>
            </div> --}}
         </div>
      </div>

      {{-- LO ULTIMO QUE HA LLEGADO --}}
      <div class="px-5 sm:px-20 mt-10" >
         <h2 class="text-3xl font-hairline text-red-500 sm:text-5xl">Mira <span class="inline-block mb-5 -mt-5 font-sans font-bold text-3xl sm:text-5xl sm:mb-0 sm:mt-0">Lo ultimo que ha llegado</span> </h2>
      </div>
      <div>
         @foreach ($ultimasCompras as $compra)
            @if ( count($compra->purchase_items) )
               <h2 class="p-5 text-2xl font-bold text-gray-600 text-center">
                  LLegó el {{$this->fecha($compra->fecha)->format('d')}} {{ $this->fecha($compra->fecha)->monthName }}
               </h2>
               <div class="splide splideIndex"> 
                  <div class="splide__track">
                     <ul class="splide__list">
                        @foreach ($compra->purchase_items as $item)
                           <li class="splide__slide border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $item->id }}">
                              <a href="{{route('products.show',$item->product)}}">
                                 <div class="w-full">
                                    @if ($item->product->image)
                                       <figure class="splide__slide__container">
                                          @if ( Storage::exists('products_thumb/' .$item->product->image->url))
                                             <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url('products_thumb/' . $item->product->image->url) }}" src="{{ Storage::url('products_thumb/' . $item->product->image->url) }}">
                                          @else
                                             <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url($item->product->image->url) }}" src="{{ Storage::url($item->product->image->url) }}">
                                          @endif
                                       </figure>
                                    @endif
                                    
                                    <div class="text-gray-600 w-max-content m-auto max-w-full">
                                          <div class="font-bold">
                                             {{$item->product->brand->name}}
                                          </div>
                     
                                       <div class="max-w-full">
                                             {{$item->product->name}}
                                          </div>                           
                                    </div>
                                 </div>
                              </a>
                              <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                              
                                 @if (isset($item->product->salePrices))
                                    @foreach ($item->product->salePrices as $price)
                                          @if ( count($item->product->salePrices)==1)
                                             <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                          @else
                                             @if ($price->quantity == 1)
                                             <div class="text-sm grid grid-cols-2">
                                                <div class="text-right">{{ $price->quantity }} x </div>
                                                <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                             </div>
                                                
                                             @else
                                                <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                                      <div class="">
                                                         {{ $price->quantity }} x  ${{ number_format($price->total_price, 0,',','.') }}
                                                      </div>
                                                      <span class="text-left bg-red-600 text-sm  sm:text-lg  px-1 mx-1  rounded text-white w-max-content" style="padding-top: 1px">
                                                         ${{ number_format($price->price, 0,',','.') }} c/u
                                                      </span>
                                                </div>
                                                
                                             @endif
                                             
                                          @endif
                                    @endforeach
                                 @endif
                        
                              </div>
                              
                        
                              @if ($item->product->stock>0)
                                 <div class="text-center mt-4 relative" >
                                       <div class="@if (session()->has('carrito.'.$item->product->id)) hidden @endif agregar_{{$item->product->id}}">
                                          <x-jet-secondary-button onclick="return addToCart({{ $item->product->id }});"> 
                                             <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                             Agregar
                                          </x-jet-secondary-button>
                                       </div>
                                       <div class="w-max-content m-auto @if (!session()->has('carrito.'.$item->product->id)) hidden @endif agregado_{{$item->product->id}}">
                                          <i class="fas fa-shopping-cart text-green-500"></i>
                                          <label for="cantidad_product_{{$item->product->id}}">
                                             <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$item->product->id}}" value="{{ (isset(session('carrito')[$item->product->id])) ? session('carrito')[$item->product->id]['cantidad']:'1' }}"
                                                   wire:ignore 
                                                   onchange="return listaSetCantidad({{ $item->product->id }}, {{ $item->product->stock }})"  
                                                   id='cantidad_product_{{ $item->product->id }}'  
                                                   data-pid="{{ $item->product->id }}"
                                             > 
                                          </label>
                                          <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $item->product->id }})" data-pid="{{$item->product->id}}">-</x-jet-secondary-button>
                                          
                                          <x-jet-secondary-button onclick="return listaAumentaCantidad({{ $item->product->id }}, {{ $item->product->stock }})" data-pid="{{$item->product->id}}">+</x-jet-secondary-button>
                                       </div>
                                 </div>
                              @else
                                 <div class="text-center mt-4">
                                    <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> Agotado</div>
                                 </div>
                              @endif                    
                           </li>    
                        @endforeach
                     </ul>
                  </div>
               </div>
            @endif
         @endforeach
      </div>

      <div class="flex flex-col-reverse sm:flex-row justify-end items-center | bg-gradient-to-r from-gray-200 via-white to-white | pb-20  mb-10 sm:p-20">
  

         <div class="px-20 my-20 filter drop-shadow-lg">
            <h2 class="text-4xl font-hairline text-red-500 sm:text-5xl"> Directo a tu <span class="block -mt-4 font-sans text-5xl font-bold sm:mt-0">Domicilio</span></h2>

            <p class="max-w-md text-gray-600">
               En 
               <span class="font-extrabold">Juansil</span> 
               queremos que te cuides. Es por eso que trabajamos para llevarte los productos directamente a tu casa. 
               <br><span class="font-bold text-red-500"> Nuestro desafío es entregarte el mejor servicio... </span><br>
               {{-- <br><span class="font-bold text-red-500">Y sin pagar de más...</span><br> --}}
            </p>
         </div>
         
      </div>

      {{-- LO  MÁS VENDIDO --}}
      <div class="px-5 sm:px-20 mt-10" >
         <h2 class="text-3xl font-hairline text-red-500 sm:text-5xl"> Mira <span class="inline-block mb-5 -mt-5 font-sans text-5xl font-bold sm:mb-0 sm:mt-0"> lo más vendido</span> </h2>
      </div>
      <div class="mb-20">
         @if ( count($loMasVendido) )
            <h2 class="p-5 text-2xl font-bold text-gray-600 text-center ">
               Top 10 más vendido
            </h2>
            <div class="splide splideIndex"> 
               <div class="splide__track">
                  <ul class="splide__list">
                     @foreach ($loMasVendido as $product)
                        <li class="splide__slide border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product[0]->id }}">
                           <a href="{{route('products.show',$product[0])}}">
                              <div class="w-full">
                                 @if ($product[0]->image)

                                    <figure class="splide__slide__container">
                                       @if ( Storage::exists('products_thumb/' .$product[0]->image->url))
                                          <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url('products_thumb/' . $product[0]->image->url) }}" src="{{ Storage::url('products_thumb/' . $product[0]->image->url) }}">
                                       @else
                                          <img class="object-contain h-48 w-full"  alt="" data-splide-lazy="{{ Storage::url($product[0]->image->url) }}" src="{{ Storage::url($product[0]->image->url) }}">
                                       @endif
                                    </figure>
                                 @endif
                                 
                                 <div class="text-gray-600 w-max-content m-auto max-w-full">
                                       <div class="font-bold">
                                          {{$product[0]->brand->name}}
                                       </div>
                  
                                    <div class="max-w-full">
                                          {{$product[0]->name}}
                                       </div>                           
                                 </div>
                              </div>
                           </a>
                           <div class="text-gray-600 w-max-content m-auto text-center mt-4 h-full flex flex-col justify-center max-w-full">
                           
                              @if (isset($product[0]->salePrices))
                                 @foreach ($product[0]->salePrices as $price)
                                       @if ( count($product[0]->salePrices)==1)
                                          <div class="text-xl h-full flex items-center"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                       @else
                                          @if ($price->quantity == 1)
                                          <div class="text-sm grid grid-cols-2">
                                             <div class="text-right">{{ $price->quantity }} x </div>
                                             <div class="text-left  px-1 mx-1"> ${{ number_format($price->total_price, 0, ',', '.') }}</div>
                                          </div>
                                             
                                          @else
                                             <div class="text-xs font-thin grid grid-cols-2 items-center max-w-full mt-2 text-right">
                                                   <div class="">
                                                      {{ $price->quantity }} x  ${{ number_format($price->total_price, 0,',','.') }}
                                                   </div>
                                                   <span class="text-left bg-red-600 text-sm  sm:text-lg  px-1 mx-1  rounded text-white w-max-content" style="padding-top: 1px">
                                                      ${{ number_format($price->price, 0,',','.') }} c/u
                                                   </span>
                                             </div>
                                             
                                          @endif
                                          
                                       @endif
                                 @endforeach
                              @endif
                     
                           </div>
                           
                     
                           @if ($product[0]->stock>0)
                              <div class="text-center mt-4 relative" >
                                    <div class="@if (session()->has('carrito.'.$product[0]->id)) hidden @endif agregar_{{$product[0]->id}}">
                                       <x-jet-secondary-button onclick="return addToCart({{ $product[0]->id }});"> 
                                          <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                          Agregar
                                       </x-jet-secondary-button>
                                    </div>
                                    <div class="w-max-content m-auto @if (!session()->has('carrito.'.$product[0]->id)) hidden @endif agregado_{{$product[0]->id}}">
                                       <i class="fas fa-shopping-cart text-green-500"></i>
                                       <label for="cantidad_product_{{$product[0]->id}}">
                                          <input type="number" min="1" class="p-1 w-9 text-center text-gray-500 cantidad_producto_{{$product[0]->id}}" value="{{ (isset(session('carrito')[$product[0]->id])) ? session('carrito')[$product[0]->id]['cantidad']:'1' }}"
                                                wire:ignore 
                                                onchange="return listaSetCantidad({{ $product[0]->id }}, {{ $product[0]->stock }})"  
                                                id='cantidad_product_{{ $product[0]->id }}'  
                                                data-pid="{{ $product[0]->id }}"
                                          > 
                                       </label>
                                       <x-jet-secondary-button onclick="return listaDisminuyeCantidad({{ $product[0]->id }})" data-pid="{{$product[0]->id}}">-</x-jet-secondary-button>
                                       
                                       <x-jet-secondary-button onclick="return listaAumentaCantidad({{ $product[0]->id }}, {{ $product[0]->stock }})" data-pid="{{$product[0]->id}}">+</x-jet-secondary-button>
                                    </div>
                              </div>
                           @else
                              <div class="text-center mt-4">
                                 <div class="cursor-default inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none    transition ease-in-out duration-150" disabled> Agotado</div>
                              </div>
                           @endif                    
                        </li>    
                     @endforeach
                  </ul>
               </div>
            </div>
         @endif
      </div>

         

   
      @push('js')
         <script>
            function productosMain(){
               return{
                     // listaAumentaCantidad: function(pid){
                     //     var cantidad =  ++document.getElementById('cantidad_product_' + pid).value;
                     //     document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                     //         element.value=cantidad;
                     //     });
                     //     this.$wire.setCantidad( pid,cantidad)
                     // },
               }
            } 

            function listaAumentaCantidad(pid, stock){
               if(document.getElementById('cantidad_product_' + pid).value >= stock){
                     alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
               }else{
                     var cantidad =  ++document.getElementById('cantidad_product_' + pid).value;
                     document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                     });
                     Livewire.emitTo('productos.index','setCantidad', pid,cantidad);
               }           
            }


            function listaDisminuyeCantidad(pid){
               if(document.getElementById('cantidad_product_' + pid).value <= 1){
                     removeFromCart2(pid);
               }else{
                     let cantidad =  --document.getElementById('cantidad_product_' + pid).value;
                     document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                     });
                     Livewire.emitTo('productos.index','setCantidad', pid,cantidad);
               }
            }


            function listaSetCantidad(pid, stock){


               let cantidad =1;
                     if(document.getElementById('cantidad_product_' + pid).value>= stock){
                        alerta_timer({icon:'warning',title:'No hay suficiente stock para agregar más unidades!!', timer: 2000});
                        cantidad = stock;
                     }else{
                        if(document.getElementById('cantidad_product_' + pid).value<=1){
                           document.getElementById('cantidad_product_' + pid).value = cantidad;
                        }else{
                           cantidad =  document.getElementById('cantidad_product_' + pid).value;
                        }
                     }
                     document.querySelectorAll(".cantidad_producto_" + pid).forEach(element => {
                        element.value=cantidad;
                     });
                     Livewire.emitTo('productos.index','setCantidad', pid,cantidad);            
            }


            function addToCart(pid){
               Livewire.emitTo('productos.index','addToCart', pid)    
            }

            function removeFromCart2(pid){
               Livewire.emitTo('productos.index','removeFromCart2', pid);
            }
      
            window.addEventListener('jsHiddenAgregar', event => {
               let agregar = document.querySelectorAll('.agregar_' + event.detail.pid);
               let agregado = document.querySelectorAll('.agregado_' + event.detail.pid);

               agregar.forEach(element => {
                  element.classList.add("hidden");
               }); 
               agregado.forEach(element => {
                  element.classList.remove("hidden");
               }); 
            })

         
            window.addEventListener('jsShowAgregar', event => {
               let agregar = document.querySelectorAll('.agregar_' + event.detail.pid);
               let agregado = document.querySelectorAll('.agregado_' + event.detail.pid);

               agregar.forEach(element => {
                  element.classList.remove("hidden");
               }); 
               agregado.forEach(element => {
                  element.classList.add("hidden");
               }); 
            })

            
         </script>
      @endpush

   </div>


   
</div>



