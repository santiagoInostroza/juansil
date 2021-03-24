<div >
    
        @if ($movimiento->cantidad>0)
        <i class="fas fa-arrow-up p-1 bg-success mr-2"></i>
            @else
            <i class="fas fa-arrow-down p-1 bg-danger mr-2"></i>
        @endif
        {{$movimiento->cantidad}}
    </div>
    