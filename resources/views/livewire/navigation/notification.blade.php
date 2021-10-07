<div x-data="{open:@entangle('isOpenNotification')}">
  
  
    <div wire:poll.60s class="">

        <div x-on:click="$wire.openNotification()" class="relative ml-8 bg-white rounded-full text-gray-500 hover:text-gray-800 transform hover:scale-110 cursor-pointer p-1 px-2 shadow">
            <i class="fas fa-bell"></i>
            @if (auth()->user()->unreadNotifications->count())
                <span class="absolute  right-6 top-0 flex rounded-full bg-red-600 uppercase px-2 py-1 text-xs font-bold text-white">{{auth()->user()->unreadNotifications->count()}}</span>
            @endif
          
        </div>
       
        <div x-show="open" class="fixed inset-0 opacity-0 hidden" :class="{'hidden':!open}" x-on:click="open=false; $wire.isOpenSale = false"></div>
        <div x-show="open" class="fixed right-0 mt-2 bg-white rounded-md shadow-lg  hidden" :class="{'hidden':!open}" style="width:20rem;" >
          
          
            <div class="overflow-y-auto overflow-x-hidden max-h-96">
             
                @if (auth()->user()->notifications->count())
                    @foreach (auth()->user()->notifications->take(20) as $noti) 
                            @if ($noti->type == "App\Notifications\SaleNotification")
                                <div x-on:click="$wire.openSale({{ $noti->data['sale_id'] }}, '{{ $noti->id }}' );" class="flex items-center px-4 py-3 border-b hover:bg-gray-300 -mx-2   @if ($noti->read_at == null) bg-gray-200 @endif cursor-pointer">
                                    {{-- <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar"> --}}
                                    <i class="fas fa-shopping-cart"></i>
                                    <p class="text-gray-600 text-sm mx-2">
                                        <span class="font-bold" href="#">{{$noti->data['customer']}}</span> 
                                        ha agendado un  <span class="font-bold text-blue-500" href="#">pedido </span> por ${{number_format($noti->data['total'],0,',','.')}} 
                                        @if($noti->data['delivery_date']!=null) para el {{Helper::fecha( $noti->data['delivery_date'] )->dayName }} @endif, 
                                        {{ Helper::fecha( $noti->data['date'] )->diffForHumans() }}
                                
                                    </p>
                                </div>                  
                            @endif 
             
                    @endforeach
            
                @else
                    <p class="text-gray-600 text-sm m-2 text-center">No tienes notificaciones</p>
                @endif
            </div>
            <a href="#" class="block bg-gray-800 text-white text-center font-bold py-2">Ver todas las notificaciones</a>
           
        </div>  
        <div>
            </div>   

    </div>

    {{-- MODALS --}}
    @if ($isOpenSale)
        <div x-show="open">
            <x-modal.modal2>
                <div class="p-4 max-w-sm md:max-w-max-content">
                    <div class="flex justify-between items-center gap-4 py-4">
                        <h2 class="text-2xl font-bold text-gray-600">Venta {{$sale->id}}</h2>
                        <div x-on:click="$wire.isOpenSale=false" class="shadow rounded-full hover:bg-red-500 hover:text-white px-3 py-1 cursor-pointer"><i class="fas fa-times"></i></div>
                    </div>
                    <div class="flex justify-between items-center gap-4 py-4">
                        <h2 class="font-bold text-gray-600">{{$sale->customer->name}}</h2>
                        <div>  {{ Helper::fecha($sale->date)->dayName }} {{ Helper::fecha($sale->date)->format('d-m-y') }} </div>
                    </div>
                  
                    
                    @if ($sale->delivery)
                        <h2 class="pl-2"><i class="fas fa-truck"></i> Despacho</h2>
                        <div class="p-2 rounded-xl border ">
                            <div>  {{ Helper::fecha($sale->delivery_date)->dayName }} {{ Helper::fecha($sale->delivery_date)->format('d-m-y') }} </div>
                            <div>Direccion: {{ $sale->customer->direccion }}</div>
                        </div>
                    @endif

                    @if ($sale->comments)
                        <div class="p-4 rounded-xl border "> {{$sale->comments}}</div>
                    @endif
                    <div class="p-5 mx-auto border rounded-xl max-h-96   overflow-auto my-4">
                        <table class="mx-auto table-fixed w-max-content">
                            <thead>
                                <tr>
                                    <th class="w-1/6">Imagen</th>
                                    <th class="w-2/6">Producto</th>
                                    <th class="w-1/6">Precio</th>
                                    <th class="w-1/6">Precio por caja</th>
                                    <th class="w-1/6">Precio total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sale->sale_items as $item)
                                    <tr>
                                        <td class="">
                                            <div class="flex justify-center">
                                                <figure>
                                                    @if (Storage::exists('products_thumb/'. $item->product->image->url))
                                                        <img class="object-contain w-20 h-20 text-center" src="{{Storage::url('products_thumb/' . $item->product->image->url)}}" alt="{{$item->product->name}}">
                                                    @else
                                                        <img class="object-contain w-20 h-20 text-center" src="{{Storage::url($item->product->image->url)}}" alt="">
                                                    @endif
                                                </figure>
                                            </div>
                                        </td>
                                        <td class="text-left">  {{$item->cantidad}}  {{$item->product->name}} x  {{$item->cantidad_por_caja}} un. </td>
                                        <td class="text-center">${{number_format($item->precio,0,',','.')}}</td>
                                        <td class="text-center">${{number_format($item->precio_por_caja,0,',','.')}}</td>
                                        <td class="text-center">${{number_format($item->precio_total,0,',','.')}}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                        <div class="flex justify-end items-center">
                            <div class="grid grid-cols-2 gap-4">
                                @if ($sale->delivery)
                                    <div> Subtotal </div> <div> ${{ number_format($sale->subtotal,0,',','.') }} </div>
                                    <div>Despacho </div> <div> ${{ number_format($sale->delivery_value,0,',','.') }} </div>
                                @endif
                                <div class="font-bold">Total </div> <div class="font-bold">${{ number_format($sale->total,0,',','.') }} </div>
                            </div>
                    </div>
                   
                    
                </div>
            </x-modal.modal2>
        </div>
    @endif


  
</div>
