<div> 
  
  TOTAL MES
  {{$sales['totalMonth']}}
  {{$sales['maxDay']}}
  <div>
    {{-- {{$sales}} --}}
  </div>
  <div>
  </div>

  @foreach ($period as $date)
    <div class="flex justify-between items-center gap-2 ">
      <div class="flex gap-4 items-center w-full">
        <div class="text-sm w-14"> {{Str::upper(Str::limit($date->dayName, 1, ''))}}  {{$date->format('d')}}</div>
        <div class="flex gap-16 w-96 items-center ">
          <div class="border text-white font-bold py-1" style="text-shadow: 1px 1px #000000; width: {{$sales[$date->format('Y-m-d')]['sales_percentage']}}%; background: rgb({{  255 - ($sales[$date->format('Y-m-d')]['sales_percentage'] * 2.55)}}, 100, 0)">
            <div class="">${{number_format($sales[$date->format('Y-m-d')]->sum('total'),0,',','.')}}</div>
          </div>
          <div style="text-shadow: 1px 1px white">{{number_format($sales[$date->format('Y-m-d')]['sales_percentage'],0,',','.')}}%</div>
        </div>
      </div>
      <div class="">
        <a class="p-2 shadow bg-gray-100 rounded text-gray-600 font-bold tracking-widest uppercase text-sm" href="{{route('admin.deliveries.index',$date)}}" target="_blank">Deliveries</a>
      </div>
      
    
      
    </div>
    <div>
    </div>
    @if ($date->format('N')==7)
        <div class="p-4 flex gap-4 bg-red-100">
          <div>
            <div>Total</div>
            {{-- <div>${{number_format($totalSemana,0,',','.')}}</div> --}}
          </div>
          <div>
            <div>Total Pagado</div>
            {{-- <div>${{number_format($totalSemanaPagado,0,',','.')}}</div> --}}
          </div>
          <div>
            <div>Pendiente</div>
            {{-- <div>${{number_format($diferenciaSemana,0,',','.')}}</div> --}}
          </div>
        </div>
        <br><br>
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
