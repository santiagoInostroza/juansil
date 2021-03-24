<div>
    <table>
        @foreach ($stock->product->salePrices as $precio)
            <tr>
                <td>x{{ $precio->quantity }}</td>
                <td>
                    @if ($precio->total_price != $precio->price )
                        (${{ number_format($precio->total_price, 0, ',', '.') }})
                    @endif  
                </td>
                <td> ${{ number_format($precio->price, 0, ',', '.') }}</td>
                <td> %{{ number_format((($precio->price - $stock->precio) / $precio->price) * 100, 1) }} </td>
            </tr>
        @endforeach
    </table>
</div>
