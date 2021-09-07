<div x-data="{open:false}">
    <div wire:poll.1s>

        <div x-on:click="open=!open;$wire.markAsRead()" class="relative ml-6 bg-white rounded-full text-gray-500 hover:text-gray-800 transform hover:scale-110 cursor-pointer">
            <i class="fas fa-bell"></i>
            @if (auth()->user()->unreadNotifications->count())
                <span class="absolute  right-4 top-0 flex rounded-full bg-red-600 uppercase px-2 py-1 text-xs font-bold text-white">{{auth()->user()->unreadNotifications->count()}}</span>
            @endif
        </div>
       

        <div x-show="open" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden" :class="{'hidden':!open}" style="width:20rem;" x-on:click.away="open=false">
          
          
            <div class="py-2">
                @if (auth()->user()->notifications->count())
                    @foreach (auth()->user()->notifications as $noti)                    
                        <a href="{{ route('admin.sales.show', $noti->data['sale_id']) }}"" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                            {{-- <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar"> --}}
                            <i class="fas fa-shopping-cart"></i>
                            <p class="text-gray-600 text-sm mx-2">
                                <span class="font-bold" href="#">{{$noti->data['customer']}}</span> 
                                ha agendado un  <span class="font-bold text-blue-500" href="#">pedido </span> por ${{number_format($noti->data['total'],0,',','.')}} 
                                @if($noti->data['delivery_date']!=null) para el {{Helper::fecha( $noti->data['delivery_date'] )->dayName }} @endif 
                                , {{ Helper::fecha( $noti->data['date'] )->diffForHumans() }}
                            </p>
                        </a>
                    @endforeach
                    
                    {{-- <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80" alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-blue-500" href="#">Test with TDD</span> artical . 1h
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80" alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                        </p>
                    </a> --}}
                  
                @else
                    <p class="text-gray-600 text-sm m-2 text-center">No tienes notificaciones</p>
                @endif
            </div>
            {{-- <a href="#" class="block bg-gray-800 text-white text-center font-bold py-2">See all notifications</a> --}}
           
        </div>


         {{-- <div x-show='open'  x-on:click.away="open=false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-40 hidden" :class="{'hidden': !open}"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
            
           
            <a href="{{ route('admin.home') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tienes Notificaciones</a>
           
            @can('products.specialPrice')
                <a href="{{ route('products.specialPrice') }}"  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Precios especiales</a>
            @endcan                     
        
            <form method="POST" action="{{ route('logout') }}">@csrf
                <a 
                    href="{{ route('logout') }}"  
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                    role="menuitem" 
                    onclick="event.preventDefault();this.closest('form').submit();">
                    Cerrar sesion
                </a>
            </form>

        </div> --}}



    </div>
</div>
