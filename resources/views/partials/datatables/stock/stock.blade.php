<div>

    <div style="width: 60px; display:inline-block">{{ $stock->stock }} u.</div>
    @if ($stock->product->stock >= $stock->product->stock_min)

    @else
        <i class="fas fa-exclamation-triangle bg-warning p-2"></i>
    @endif
</div>
