<div>
     
   {{-- BANNER --}}
   <div class="mt-10">
      {{-- CREAR INICIO DE PRODUCTOS    --}}

      <div
      class="max-h-full b-8 ta-gallery ta-gallery-aspect-instagram "
      style="height: max-content"
      x-data="taGallery()"
      x-init="init()"
      data-start="0"
      data-autoplay="true"
      data-interval="5000"
      data-timing="ease-in-out"
      data-duration="0.3s"
   >
      <!--- START SLIDES /-->
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
   
   
      <!--- START BUTTONS /-->
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
      <!--- END BUTTONS /-->
   </div>


   {{-- PRODUCTOS POR CATEGORIA --}}
   @foreach ($categories as $categoria)
      <h2 class="my-10 px-10 text-xl font-bold text-gray-600">{{$categoria->name}}</h2>
      <div 
         class="splide" 
         data-splide='{
            "type":"loop",
            "perPage": 2
            {{-- "trimSpace": false , --}}
            {{-- "focus" : "center"  --}}
         }'
      > 
         <div class="splide__track">
            <ul class="splide__list">
               @foreach ($categoria->products as $product)
                  <li class="splide__slide border-b border-r  p-4 flex flex-col justify-between" wire:key="{{ $product->id }}">
                     <a href="{{route('products.show',$product)}}">
                        <div class="w-full">
                           @if ($product->image)
                              <figure class="splide__slide__container">
                                 <img class="object-contain h-48 w-full" src="{{ Storage::url($product->image->url) }}" alt="">
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
                           @if (!session()->has('carrito.'.$product->id))
                                 {{-- <div wire:loading wire:target="{{$product->id}}" class="font-bold text-yellow-300 p-2 font-xl">Agregando al carrito ...</div> --}}
                                 <x-jet-secondary-button onclick="return addToCart({{$product->id}});"> 
                                    <i class="fas fa-cart-plus mr-1 mb-1" ></i> 
                                    Agregar
                                 </x-jet-secondary-button>
                           @else
                                 <div class="w-max-content m-auto">
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
                              
                           @endif
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
   @endforeach


      
   <div class="flex justify-start bg-gradient-to-r from-white to-gray-200">
      <div class="px-20 my-20" >
         <h2 class="text-3xl font-hairline text-red-500 sm:text-5xl">Explora nuestros <span class="inline-block mb-5 -mt-5 font-sans text-5xl font-bold sm:mb-0 sm:mt-0">productos</span></h2>
         <p class="max-w-md text-gray-600">
            <span class="font-extrabold"></span>Somos un joven emprendimiento y lucharemos por hacer crecer nuestra variedad de productos para que no te falte nada.
         </p>
         
      
         <div class="flex items-center justify-between max-w-xs gap-1 p-2 my-8 sm:gap-6 sm:max-w-md sm:w-max-content">
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
         </div>
      </div>
      
   </div>







      <div class="flex items-center justify-center w-screen">
         <div class="text-3xl">
         <figure>
            <img class="object-contain w-screen h-full" src="{{url('images/portada/Juansil2.png')}}" alt="">
         </figure>
         </div>
      </div>

      <div class="flex flex-col-reverse sm:flex-row justify-between items-center | bg-gradient-to-r from-gray-200 via-white to-white | pb-20  mb-10 sm:p-20">
         <div>
            <img class="object-cover max-w-xs sm:max-w-sm " src="{{url('images/portada/repartidor.jpg')}}" alt="">
         </div>

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



      <hr>
      breve explicacion del sistema de compras
      <hr>
      ofertas
      <hr>

      lista x categorias
      <hr>
      lista x más VENDIDOS
      <hr>
      Lo ultimo que llegó


   
   </div>

   
</div>

