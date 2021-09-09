<div x-data="{open:@entangle('isOpenNotification')}">
  
  
    <div wire:poll.120s>

        <div x-on:click="$wire.openNotification()" class="relative ml-8 bg-white rounded-full text-gray-500 hover:text-gray-800 transform hover:scale-110 cursor-pointer p-1 px-2 shadow">
            <i class="fas fa-truck"></i>
            @if ($pendings->count())
                <span class="absolute  right-6 top-0 flex rounded-full bg-red-600 uppercase px-2 py-1 text-xs font-bold text-white">{{ $pendings->count() }}</span>
            @endif
          
        </div>
       

        <div x-show="open" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden" :class="{'hidden':!open}" style="width:20rem;" x-on:click.away="open=false">
            <div class="py-2">
            
                @if ($pendings->count() || $delivereds->count())
                    <h3 class="text-gray-400 text-center p-1">Pendientes {{ $pendings->count() }} </h3>
                    @foreach ($pendings as $pending)                        
                            <a href="" class="flex items-center px-4 py-3 border-b hover:bg-gray-300 -mx-2 bg-gray-200">
                                {{-- <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar"> --}}
                                <i class="fas fa-truck"></i>
                                <p class="text-gray-600 text-sm mx-2">
                                    <span class="font-bold" href="#">{{$pending->customer->comuna}}</span> 
                                    {{ $pending->customer->name}}
                                    <span class="font-bold text-blue-500" href="#">  </span> 
                                    por ${{ number_format($pending->total,0,',','.') }}                       
                                </p>
                            </a>                            
                      
                    @endforeach
                    <hr>
                    <h3 class="text-gray-400 text-center p-1">Entregadas  {{ $delivereds->count() }} </h3>
                    @foreach ($delivereds as $delivered)  
                      
                            <a href="" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                {{-- <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar"> --}}
                                <i class="fas fa-truck"></i>
                                <p class="text-gray-600 text-sm mx-2">
                                    <span class="font-bold" href="#">{{ $delivered->customer->comuna }}</span> 
                                    {{ $delivered->customer->name }}
                                    <span class="font-bold text-blue-500" href="#"> </span> 
                                    por ${{ number_format($delivered->total,0,',','.') }} 
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
                    
                    {{-- <a href="https://api.whatsapp.com/send?phone=56973231830&text=Me%20gustaría%20saber%20el%20precio%20del%20sitio%20web«%0D%0A»">ws</a> --}}
                  
                @else
                    <p class="text-gray-600 text-sm m-2 text-center">No tienes notificaciones</p>
                @endif
            </div>
            <a href="#" class="block bg-gray-800 text-white text-center font-bold py-2">Ver todas las notificaciones</a>
           
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
