@extends('layouts.simple')

@section('content')
@php
     if (Auth::user() && Auth::user()->id == 6) {
            session()->forget('carritoSpecial');
            $this->dispatchBrowserEvent('alerta_timer', [
                'icon' => 'warning',
                'msj' => "Se borro productos del carrito",
            ]);


        }
@endphp
    @livewire('productos.special-price')   
@endsection
    
   