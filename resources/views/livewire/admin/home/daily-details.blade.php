<div> 
  @php
      $totalSemana = 0;
      $totalSemanaPagado = 0;
  @endphp
  

  @foreach ($period as $item)
    

    @php
        $date = Str::limit($item, 10, '');
        $total = $salesArray[$date]->sum('total');
        $totalPagado = $salesArray[$date]->where('payment_status','=','3')->sum('total');

        $totalSemana +=$total;
        $totalSemanaPagado +=$totalPagado;
    @endphp   
    
    <div class="border">
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
      </div>
    
       
    </div>
    @if ($item->format('N')==7)
        <div class="p-4 flex gap-4 bg-red-100">
          <div>
            <div>Total</div>
            <div>${{number_format($total,0,',','.')}}</div>
          </div>
          <div>
            <div>Total Pagado</div>
            <div>${{number_format($totalSemanaPagado,0,',','.')}}</div>
          </div>
        </div>
        <br><br>
      @php
          $totalSemana = 0;
          $totalSemanaPagado = 0;
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
