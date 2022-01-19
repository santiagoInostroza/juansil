<div class="flex flex-col gap-4">
    <section>
        <figure x-data >
            <template x-if="window.outerWidth>=768">
                <img src="{{asset('images/portada/banner_leches_xl.webp')}}" alt="portada">
            </template>
            <template x-if="window.outerWidth<768">
                <img src="{{asset('images/portada/banner_leches_lg.webp')}}" alt="portada">
            </template>
        </figure>
    </section>
    <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach ($products as $product)

           <li class="border flex flex-col justify-between">
               <figure> <img class="object-cover w-full" src="{{ '/storage/products_thumb/' . $product->image->url }}" alt="{{$product->name}}"> </figure>
               <div class="flex justify-center">
                   <div>
                       <h2 class="font-bold text-lg  text-gray-800"> {{$product->name}} </h2>
                       <h3 class="text-gray-600">{{$product->brand->name}}</h3>
                    </div>
                </div>
              
           </li>


        @endforeach
    </ul>
    
</div>
