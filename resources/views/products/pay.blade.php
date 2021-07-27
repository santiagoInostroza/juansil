<x-app-layout>
    {{-- <div class="container py-12 grid grid-cols-12 gap-6">
        <div class="col-span-7">
            <article class="card">
                <div class="card-body">
                    <div class="flex">
                        <img src="{{Storage::url($product->image->url)}}" alt="" class="w-48 h-48 object-cover">
                        <div class="ml-4 flex justify-between items-center self-start flex-1">
                            <h1 class="font-bold text-lg uppercase  text-gray-500">{{$product->name}}</h1>
                            <p class="font-bold text-gray-500">${{ round($product->salePrices[0]->price)}}</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <p class="text-sm text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi deserunt illo totam, reprehenderit mollitia quos, sit voluptates iure vitae sunt, quae a repellat similique minima nobis eos. Quo, laborum perferendis.</p>
                </div>
            </article>
        </div>
        <div class="col-span-4">
                @livewire('billings.product-pay', ['product' => $product])
        </div>
    </div> --}}
</x-app-layout>