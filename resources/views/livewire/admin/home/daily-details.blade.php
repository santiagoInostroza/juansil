<div> 
  @php
      $totalSemana = 0;
      $totalSemanaPagado = 0;
  @endphp
  

  @foreach ($period as $item)
    

    @php
        $date = Str::limit($item, 10, '');
        $total = $salesArray[$date]->sum('total');
        $totalPagado = $salesArray[$date]->where('payment_status','!=','1')->sum('payment_amount');
        $diferencia = $total - $totalPagado;
        $diferenciaDeliveries = $salesArray[$date]->where('delivery','=',1)->where('pending_amount','>',0)->count();
        $diferenciaBodega = $salesArray[$date]->where('delivery','!=',1)->where('pending_amount','>',0)->count();

        $totalSemana +=$total;
        $totalSemanaPagado +=$totalPagado;
        $diferenciaSemana = $totalSemana - $totalSemanaPagado;
    @endphp   
    
    <div class="border flex justify-between items-center gap-2">
      <div>
        <div class="text-sm">
          {{Str::upper(Str::limit($item->dayName, 3, ''))}} 
          {{$item->format('d')}}
        </div>
        <div class="p-4 flex gap-4">
          <div>
            <div>total</div>
            <div>${{number_format($total,0,',','.')}}</div>
          </div>
          <div>
            <div>total Pagado</div>
            <div>${{number_format($totalPagado,0,',','.')}}</div>
          </div>
          <div>
            <div>Diferencia (deliveries{{$diferenciaDeliveries}} bodega{{$diferenciaBodega}})</div>
            <div>${{number_format($diferencia,0,',','.')}}</div>
          </div>
        </div>
      </div>
      <div>
        <a class="p-2 shadow bg-gray-100 rounded text-gray-600 font-bold tracking-widest uppercase text-sm" href="{{route('admin.deliveries.index',$date)}}" target="_blank">Deliveries</a>
      </div>
      
    
       
    </div>
    <div>
      {{$salesArray[$date]}}
    </div>
    @if ($item->format('N')==7)
        <div class="p-4 flex gap-4 bg-red-100">
          <div>
            <div>Total</div>
            <div>${{number_format($totalSemana,0,',','.')}}</div>
          </div>
          <div>
            <div>Total Pagado</div>
            <div>${{number_format($totalSemanaPagado,0,',','.')}}</div>
          </div>
          <div>
            <div>Pendiente</div>
            <div>${{number_format($diferenciaSemana,0,',','.')}}</div>
          </div>
        </div>
        <br><br>
      @php
          $totalSemana = 0;
          $totalSemanaPagado = 0;
          $diferenciaSemana = 0;
      @endphp
    @endif
  @endforeach
    
  {{-- @foreach ($sales as $sale)
      <div>{{$sale->id}} </div>
      <div>{{$sale->total}}</div>
      <div>{{$sale->date}}</div>
      <div>{{$sale->payment_amount}}</div>
      <div>{{$sale->payment_status}}</div>
      <div>{{$sale->pending_amount}}</div>
      <div>payment_date {{$sale->payment_date}}</div>
      <div>{{$sale->delivery}}</div>
      <div>{{$sale->delivery_date}}</div>
      <div>{{$sale->date_delivered}}</div>
      <div>{{$sale->delivery_stage}}</div>
      <div>{{$sale->comments}}</div>
      <div>{{$sale->total_cost}}</div>
      <div>{{$sale->delivery_value}}</div>
      <div>{{$sale->subtotal}}</div>
      <div>{{$sale->sale_type}}</div>
  @endforeach --}}
</div>
