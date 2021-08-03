<div class="mt-10">
   {{-- CREAR INICIO DE PRODUCTOS    --}}
  

    {{-- CARRUSEL --}}
    <div class="relative bg-white shadow-2xl carousel">
      <div class="relative w-full overflow-hidden carousel-inner">
        <!--Slide 1-->
         <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
         <div class="absolute opacity-0 carousel-item" style="height:50vh;">
            <div class="">
               <img class="object-cover w-screen" src="{{url('images/portada/Juansil1.png')}}" alt="">  
            </div>
         </div>
         <label for="carousel-3" class="absolute inset-y-0 left-0 hidden w-10 h-10 my-auto ml-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer prev control-1 md:ml-10 hover:text-white hover:bg-blue-700" style="z-index: 9">‹</label>
         <label for="carousel-2" class="absolute inset-y-0 right-0 hidden w-10 h-10 my-auto mr-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer next control-1 md:mr-10 hover:text-white hover:bg-blue-700" style="z-index: 9">›</label>
         
         <!--Slide 2-->
         <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
         <div class="absolute opacity-0 carousel-item" style="height:50vh;">
            <div class="block w-full h-full text-5xl text-center text-white bg-orange-500">
               <img class="object-cover w-screen" src="{{url('images/portada/Juansil2.png')}}" alt=""> 
            </div>
         </div>
         <label for="carousel-1" class="absolute inset-y-0 left-0 hidden w-10 h-10 my-auto ml-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer prev control-2 md:ml-10 hover:text-white hover:bg-blue-700" style="z-index: 9">‹</label>
         <label for="carousel-3" class="absolute inset-y-0 right-0 hidden w-10 h-10 my-auto mr-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer next control-2 md:mr-10 hover:text-white hover:bg-blue-700" style="z-index: 9">›</label> 
         
         <!--Slide 3-->
         <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
         <div class="absolute opacity-0 carousel-item" style="height:50vh;">
            <div class="block w-full h-full text-5xl text-center text-white bg-green-500">Slide 3</div>
         </div>
         <label for="carousel-2" class="absolute inset-y-0 left-0 hidden w-10 h-10 my-auto ml-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer prev control-3 md:ml-10 hover:text-white hover:bg-blue-700" style="z-index: 9">‹</label>
         <label for="carousel-1" class="absolute inset-y-0 right-0 hidden w-10 h-10 my-auto mr-2 text-3xl font-bold leading-tight text-center text-black bg-white rounded-full cursor-pointer next control-3 md:mr-10 hover:text-white hover:bg-blue-700" style="z-index: 9">›</label>
   
         <!-- Add additional indicators for each slide-->
         <ol class="carousel-indicators">
            <li class="inline-block mr-3">
               <label for="carousel-1" class="block text-4xl text-white cursor-pointer carousel-bullet hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
               <label for="carousel-2" class="block text-4xl text-white cursor-pointer carousel-bullet hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
               <label for="carousel-3" class="block text-4xl text-white cursor-pointer carousel-bullet hover:text-blue-700">•</label>
            </li>
         </ol>
         
      </div>
   </div>
   
   <hr>

   
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



   <div class="flex items-center justify-center w-screen h-64">
      <div class="text-3xl">
        <figure>
           <img class="object-cover w-screen h-64" src="{{url('images/portada/Juansil1.png')}}" alt="">
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

