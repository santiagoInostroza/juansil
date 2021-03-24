<div>
   
    @foreach ($product->salePrices as $price)
        <div>
        x {{$price->quantity}} ${{number_format($price->price,0,',','.')}} 
        @if ($price->price!=$price->total_price)
            (${{number_format($price->total_price,0,',','.')}})
        @endif
        </div>
    @endforeach
</div>