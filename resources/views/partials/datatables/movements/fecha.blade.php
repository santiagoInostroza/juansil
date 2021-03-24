<div class="" style="width: max-content ;margin: 0 auto">
   
        {{ date('d-m-Y', strtotime($movimiento->product->created_at)) }}
   
    
       {{ date('H:i', strtotime($movimiento->product->created_at)) }}
   
</div>
