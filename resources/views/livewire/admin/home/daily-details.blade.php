<div> 
  @php
      $totalSemana = 0;
  @endphp
  <div>{{$sales->count()}}</div>
  @foreach ($sales as $sale)
    <div>{{$sale->payment_date}} {{$sale->total}}</div>
      
  @endforeach
  @foreach ($period as $item)

    @php
        // $total = $sales->where('payment_date','=',$item)->sum('total');
        $total = $sales->where('payment_date','like','%'. Str::limit($item,10,'') . '%')->sum('total');

        $totalSemana +=$total;
    @endphp

    @if ($item->format('N')==1)
      <div class="p-4">

    @endif
    
    <div class="border">
      <div class="text-sm">
          {{Str::upper(Str::limit($item->dayName, 3, ''))}} 
          {{$item->format('d')}}
      </div>
      <div class="p-4">
        <div>
          @if ($total>0)
            ${{number_format($total,0,',','.')}}
          @endif
        </div>
      </div>
    
       
    </div>
    @if ($item->format('N')==7)
        <div class="p-4">
          Total semana ${{number_format($totalSemana,0,',','.')}}
        </div>
        <br><br>
      </div>
      @php
          $totalSemana = 0;
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
