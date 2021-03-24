<div class="text-center">
    <img src="@if ($stock->product->image)  {{Storage::url($stock->product->image->url)}} @else {{Storage::url('products/sinFoto.png')}} @endif " alt="" style="width:60px">  
  </div> 