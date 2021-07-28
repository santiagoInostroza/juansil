<div class="mt-10">
   {{-- CREAR INICIO DE PRODUCTOS    --}}
  

    {{-- CARRUSEL --}}
    <div class="carousel relative shadow-2xl bg-white">
      <div class="carousel-inner relative overflow-hidden w-full">
        <!--Slide 1-->
         <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
         <div class="carousel-item absolute opacity-0" style="height:50vh;">
            <div class="">
               <img class="object-cover w-screen" src="{{url('images/portada/leche2.jpg')}}" alt="">  
            </div>
         </div>
         <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center inset-y-0 left-0 my-auto" style="z-index: 9">‹</label>
         <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center inset-y-0 right-0 my-auto" style="z-index: 9">›</label>
         
         <!--Slide 2-->
         <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
         <div class="carousel-item absolute opacity-0" style="height:50vh;">
            <div class="block h-full w-full bg-orange-500 text-white text-5xl text-center">
               <img class="object-cover w-screen" src="{{url('images/portada/abarrotes.jpg')}}" alt=""> 
            </div>
         </div>
         <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center  inset-y-0 left-0 my-auto" style="z-index: 9">‹</label>
         <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center  inset-y-0 right-0 my-auto" style="z-index: 9">›</label> 
         
         <!--Slide 3-->
         <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
         <div class="carousel-item absolute opacity-0" style="height:50vh;">
            <div class="block h-full w-full bg-green-500 text-white text-5xl text-center">Slide 3</div>
         </div>
         <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center inset-y-0 left-0 my-auto" style="z-index: 9">‹</label>
         <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center inset-y-0 right-0 my-auto" style="z-index: 9">›</label>
   
         <!-- Add additional indicators for each slide-->
         <ol class="carousel-indicators">
            <li class="inline-block mr-3">
               <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
               <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
               <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
         </ol>
         
      </div>
   </div>
   
   <hr>

   
<div class="flex justify-start bg-gradient-to-r from-white to-gray-200">
   <div class="my-20 px-20" >
      <h2 class=" text-3xl sm:text-5xl text-red-500 font-hairline">Explora nuestros <span class="font-bold font-sans text-5xl inline-block -mt-5 mb-5 sm:mb-0 sm:mt-0">productos</span></h2>
      <p class="text-gray-600 max-w-md">
         <span class="font-extrabold"></span>Somos un joven emprendimiento y lucharemos por hacer crecer nuestra variedad de productos para que no te falte nada.
      </p>
      
     
      <div class="my-8 flex justify-between items-center gap-1 sm:gap-6 p-2 max-w-xs sm:max-w-md sm:w-max-content">
         <a href="{{route('products.lista')}}">
            <img class="object-cover rounded-full h-20 sm:h-32 w-20 sm:w-32 bg-gray-800 " src="{{url('images/min/leche_min.jpg')}}" alt="">
            <p class="text-center font-bold text-gray-600 p-2 text-sm" >Lacteos</p>
          </a>
         <a href="{{route('products.lista')}}">
            <img class="object-cover rounded-full h-20 sm:h-32 w-20 sm:w-32 bg-gray-800 " src="{{url('images/min/abarrotes3_min.jpeg')}}" alt="">
            <p class="text-center font-bold text-gray-600 p-2 text-sm" >Abarrotes</p>
          </a>
         <a href="{{route('products.lista')}}">
            <img class="object-cover rounded-full h-20 sm:h-32 w-20 sm:w-32 bg-gray-800 " src="{{url('images/min/abarrotes_min.jpg')}}" alt="">
            <p class="text-center font-bold text-gray-600 p-2 text-sm" >Todo</p>         
         </a>
      </div>
   </div>
   
</div>



   <div class="w-screen h-64 flex items-center justify-center">
      <div class="text-3xl">
        <figure>
           <img class="h-64 object-cover w-screen" src="{{url('images/portada/leche2.jpg')}}" alt="">
        </figure>
      </div>
    </div>

   <div class="flex flex-col-reverse sm:flex-row justify-between items-center | bg-gradient-to-r from-gray-200 via-white to-white | pb-20  mb-10 sm:p-20">
      <div>
         <img class="object-cover max-w-xs sm:max-w-sm " src="{{url('images/portada/repartidor.jpg')}}" alt="">
      </div>

      <div class="my-20 px-20 filter drop-shadow-lg">
         <h2 class="text-4xl sm:text-5xl text-red-500 font-hairline"> Directo a tu <span class="block font-bold font-sans text-5xl -mt-4 sm:mt-0">Domicilio</span></h2>

         <p class="text-gray-600 max-w-md">
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

