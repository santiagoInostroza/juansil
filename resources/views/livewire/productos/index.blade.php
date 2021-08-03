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
            <br><span class="font-bold text-red-500">Y sin pagar de más...</span><br>
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

