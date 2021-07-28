
@extends('layouts.admin')

@section('content')
<x-slot name='titulo'>Resumen</x-slot>
    @livewire('routes.sectors')
@endsection