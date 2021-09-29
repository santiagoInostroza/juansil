@can('products.specialPrice')
    @extends('layouts.simple')
    @section('content')


    @livewire('productos.orders')   
@endsection

@else
    <x-app-layout>
        @livewire('productos.orders')   
    </x-app-layout>
  
@endcan   



    
   