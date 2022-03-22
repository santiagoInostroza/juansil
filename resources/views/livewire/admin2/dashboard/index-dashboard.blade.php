<div>
    <div class="grid gap-6 my-10">
        
       



        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-6 shadow rounded bg-white ">
                <div>
                    <i class="fas fa-file-invoice text-4xl text-green-500"></i>
                </div>
                <h2 class="font-bold text-xl my-2">Compras (
                    {{-- {{ $purchases->count() }} --}}
                    )</h2>
                <div class="text-xl md:text-4xl"> 
                    {{-- ${{ number_format($purchases->sum('total'),0,',','.')}} --}}
                </div>
                <div class="hidden md:block mt-4">
                    <div>
                       
                    </div>
                    <div>
                        Pendientes
                         {{-- ${{  number_format($purchases->sum('pending_amount'),0,',','.') }} --}}
                    </div>
                    <div>
                        Pagadas  
                        {{-- ${{number_format($purchases->sum('payment_amount'),0,',','.')}} --}}
                    </div>
                </div>
            </div>
           
           
            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-cash-register text-4xl text-green-500"></i>
                </div>
                <h2 class="font-bold text-xl my-2">Ventas (
                    {{-- {{ $sales->count() }} --}}
                    )</h2>
                <div class="text-xl md:text-4xl"> 
                    {{-- ${{ number_format($sales->sum('total'),0,',','.') }} --}}
                </div>
                <div class="hidden md:block mt-4">
                    <div>
                        Pendientes 
                        {{-- ${{  number_format($sales->sum('pending_amount'),0,',','.') }} --}}
                    </div>
                    <div>
                        Pagadas 
                         {{-- ${{number_format($sales->sum('payment_amount'),0,',','.')}} --}}
                    </div>
                </div>
            </div>
            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-money-bill  text-4xl text-green-500"></i>
                   
                </div>
                <h2 class="font-bold text-xl my-2">Diferencia</h2>
                <div class="text-xl md:text-4xl">
                     {{-- ${{ number_format($sales->sum('total') - $purchases->sum('total'),0,',','.')}} --}}
                    </div>
            </div>

            <div class="p-6 shadow rounded bg-white">
                <div>
                    <i class="fas fa-money-bill  text-4xl text-green-500"></i>
                   
                </div>
                <h2 class="font-bold text-xl my-2">Stock</h2>
            
                <div class="text-xl md:text-4xl">
                     {{-- ${{ number_format($stock,0,',','.')}} --}}
                    </div>
            </div>
        </div>
        
    </div>

    <div>
        Agregar más estadisticas...

    </div>
</div>
