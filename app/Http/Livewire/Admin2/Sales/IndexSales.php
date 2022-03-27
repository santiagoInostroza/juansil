<?php

namespace App\Http\Livewire\Admin2\Sales;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSales extends Component{
    use WithPagination;

    public $search;
    public $name;
    public $columns;
    public $rows;
    public $filterDate;

    public function mount(){
        // session()->forget('saleColumns');
        $this->id = "";
        $this->name = "";
        $this->search = "";
        $this->columns = $this->loadColumns();
        $this->rows =(session()->has('saleFiles'))? session('saleFiles'): 10;
        $this->filterDate =(session()->has('saleFilterDate'))? session('saleFilterDate'): 'all';
    }

    

    public function render(){

        $strings = explode(' ', trim($this->search));
        

        $sales= Sale::join('customers','customers.id','sales.customer_id')
        ->with('customer');
      
        if ($this->filterDate =='todaysRoute') {
            $sales = $sales->whereDate('delivery_date', Carbon::today());
        }
        if ($this->filterDate =='sheduledToday') {
            $sales = $sales->whereDate('date', Carbon::today());
        }
        if ($this->filterDate =='threeDaysAgo') {
            $sales = $sales->whereDate('date', '>=', Carbon::now()->subDays(3));
        }
        if ($this->filterDate =='tenDaysAgo') {
            $sales = $sales->whereDate('date', '>=', Carbon::now()->subDays(10));
        }

        $sales = $sales->where(function($query) use ($strings){
            foreach ($strings as $string ) {
             $query 
              ->orWhere('name','like', '%' . $string . '%') 
              ->orWhere('direccion','like', '%' . $string . '%');
            }
        })
        ->select('sales.*','customers.name as name', 'customers.direccion as address')
        ->orderBy('id', 'desc')
        ;
        

        $customerNames = $sales->pluck('customers.name')->unique();
        // $seller = $sales->pluck('customers.name')->unique();
       

        return view('livewire.admin2.sales.index-sales',[
            'sales'=>$sales->paginate($this->rows),
            'customerNames'=>$customerNames,
        ]);
    }

    public function loadColumns($type = ''){
        
            $columns['id']=(session()->has('saleColumns.id')) ? session('saleColumns.id') :false;
            $columns['nombre']=(session()->has('saleColumns.nombre')) ? session('saleColumns.nombre') :false;
            $columns['direccion']=(session()->has('saleColumns.direccion')) ? session('saleColumns.direccion') :false;
            $columns['fecha']=(session()->has('saleColumns.fecha')) ? session('saleColumns.fecha') :false;
            $columns['total']=(session()->has('saleColumns.total')) ? session('saleColumns.total') :false;
            if(auth()->user()->hasRole('SuperAdmin') ){
                $columns['costo']=(session()->has('saleColumns.costo')) ? session('saleColumns.costo') :false;
                $columns['diferencia']=(session()->has('saleColumns.diferencia')) ? session('saleColumns.diferencia') :false;
                $columns['porcentaje']=(session()->has('saleColumns.porcentaje')) ? session('saleColumns.porcentaje') :false;
            }
            $columns['estado de pago']=(session()->has('saleColumns.estado de pago')) ? session('saleColumns.estado de pago') :false;
            $columns['tipo de pago']=(session()->has('saleColumns.tipo de pago')) ? session('saleColumns.tipo de pago') :false;
            $columns['monto pagado']=(session()->has('saleColumns.monto pagado')) ? session('saleColumns.monto pagado') :false;
            $columns['monto pendiente']=(session()->has('saleColumns.monto pendiente')) ? session('saleColumns.monto pendiente') :false;
            $columns['fecha de pago']=(session()->has('saleColumns.fecha de pago')) ? session('saleColumns.fecha de pago') :false;
            $columns['delivery']=(session()->has('saleColumns.delivery')) ? session('saleColumns.delivery') :false;
            $columns['estado de entrega']=(session()->has('saleColumns.estado de entrega')) ? session('saleColumns.estado de entrega') :false;
            $columns['fecha de entrega']=(session()->has('saleColumns.fecha de entrega')) ? session('saleColumns.fecha de entrega') :false;
            $columns['fecha entregado']=(session()->has('saleColumns.fecha entregado')) ? session('saleColumns.fecha entregado') :false;
            $columns['entregado por']=(session()->has('saleColumns.entregado por')) ? session('saleColumns.entregado por') :false;
            $columns['comentarios preventa']=(session()->has('saleColumns.comentarios preventa')) ? session('saleColumns.comentarios preventa') :false;
            $columns['vendedor']=(session()->has('saleColumns.vendedor')) ? session('saleColumns.vendedor') :false;
           
            $columns['valor despacho']=(session()->has('saleColumns.valor despacho')) ? session('saleColumns.valor despacho') :false;
            $columns['subtotal']=(session()->has('saleColumns.subtotal')) ? session('saleColumns.subtotal') :false;
            $columns['tipo venta']=(session()->has('saleColumns.tipo venta')) ? session('saleColumns.tipo venta') :false;
            $columns['comentario conductor']=(session()->has('saleColumns.comentario conductor')) ? session('saleColumns.comentario conductor') :false;
            $columns['boleta emitida']=(session()->has('saleColumns.boleta emitida')) ? session('saleColumns.boleta emitida') :false;
            $columns['boleta emitida el']=(session()->has('saleColumns.boleta emitida el')) ? session('saleColumns.boleta emitida el') :false;
            $columns['boleta emitida por']=(session()->has('saleColumns.boleta emitida por')) ? session('saleColumns.boleta emitida por') :false;
            $columns['usuario recibe pago']=(session()->has('saleColumns.usuario recibe pago')) ? session('saleColumns.usuario recibe pago') :false;
            $columns['imagen del recibo']=(session()->has('saleColumns.imagen del recibo')) ? session('saleColumns.imagen del recibo') :false;
            $columns['recibo subido el']=(session()->has('saleColumns.recibo subido el')) ? session('saleColumns.recibo subido el') :false;
            $columns['recibo subido por']=(session()->has('saleColumns.recibo subido por')) ? session('saleColumns.recibo subido por') :false;
            $columns['verificacion recibo']=(session()->has('saleColumns.verificacion recibo')) ? session('saleColumns.verificacion recibo') :false;
            $columns['recibo verificado por']=(session()->has('saleColumns.recibo verificado por')) ? session('saleColumns.recibo verificado por') :false;
            $columns['recibo verificado el']=(session()->has('saleColumns.recibo verificado el')) ? session('saleColumns.recibo verificado el') :false;
            $columns['accion']=(session()->has('saleColumns.accion')) ? session('saleColumns.accion') :false;

            if ($type == 'mobile') {
                $columns['nombre']=(session()->has('saleColumns.nombre')) ? session('saleColumns.nombre') :true;
                $columns['estado de pago']=(session()->has('saleColumns.estado de pago')) ? session('saleColumns.estado de pago') :true;
                $columns['estado de entrega']=(session()->has('saleColumns.estado de entrega')) ? session('saleColumns.estado de entrega') :true;
                $columns['imagen del recibo']=(session()->has('saleColumns.imagen del recibo')) ? session('saleColumns.imagen del recibo') :true;
                $columns['verificacion recibo']=(session()->has('saleColumns.verificacion recibo')) ? session('saleColumns.verificacion recibo') :true;
                $columns['accion']=(session()->has('saleColumns.accion')) ? session('saleColumns.accion') :true;
            
            } else if ($type == 'boleta') {
                $columns['id']=(session()->has('saleColumns.id')) ? session('saleColumns.id') :true;
                $columns['nombre']=(session()->has('saleColumns.nombre')) ? session('saleColumns.nombre') :true;
                $columns['estado de pago']=(session()->has('saleColumns.estado de pago')) ? session('saleColumns.estado de pago') :true;
                $columns['verificacion recibo']=(session()->has('saleColumns.verificacion recibo')) ? session('saleColumns.verificacion recibo') :true;
                $columns['boleta emitida']=(session()->has('saleColumns.boleta emitida')) ? session('saleColumns.boleta emitida') :true;
            
            } else {
                $columns['id']=(session()->has('saleColumns.id')) ? session('saleColumns.id') :true;
                $columns['nombre']=(session()->has('saleColumns.nombre')) ? session('saleColumns.nombre') :true;
                $columns['direccion']=(session()->has('saleColumns.direccion')) ? session('saleColumns.direccion') :true;
                $columns['fecha']=(session()->has('saleColumns.fecha')) ? session('saleColumns.fecha') :true;
                $columns['total']=(session()->has('saleColumns.total')) ? session('saleColumns.total') :true;
                if(auth()->user()->hasRole('SuperAdmin') ){
                    $columns['diferencia']=(session()->has('saleColumns.diferencia')) ? session('saleColumns.diferencia') :true;
                    $columns['porcentaje']=(session()->has('saleColumns.porcentaje')) ? session('saleColumns.porcentaje') :true;
                }
                $columns['estado de pago']=(session()->has('saleColumns.estado de pago')) ? session('saleColumns.estado de pago') :true;
                $columns['estado de entrega']=(session()->has('saleColumns.estado de entrega')) ? session('saleColumns.estado de entrega') :true;
                $columns['vendedor']=(session()->has('saleColumns.vendedor')) ? session('saleColumns.vendedor') :true;
                $columns['imagen del recibo']=(session()->has('saleColumns.imagen del recibo')) ? session('saleColumns.imagen del recibo') :true;
                $columns['verificacion recibo']=(session()->has('saleColumns.verificacion recibo')) ? session('saleColumns.verificacion recibo') :true;
                $columns['accion']=(session()->has('saleColumns.accion')) ? session('saleColumns.accion') :true;
            }
       
        
        return $columns;
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatedFiles(){
        session(['saleRows'=>$this->rows]);
    }
    

    public function updatedFilterDate(){
        session(['saleFilterDate'=>$this->filterDate]);
    }

    public function setBoleta(Sale $sale){
        $sale->boleta = 1;
        $sale->fecha_boleta = Carbon::now();
        $sale->user_boleta = auth()->user()->id;
        $sale->save();
    }

    public function setColumns($name){
        switch ($name) {
            case 'mobile':
                session()->forget('saleColumns');
                $this->columns = $this->loadColumns('mobile');
                break;
            case 'basic':
             
                session()->forget('saleColumns');
                $this->columns = $this->loadColumns();
                break;
            case 'boleta':
                session()->forget('saleColumns');
                $this->columns = $this->loadColumns('boleta');
                break;
            case 'all':
                foreach ($this->columns as $nameColumn => $valueColumn) {
                    $this->columns[$nameColumn] = true;
                }
                session(['saleColumns' => $this->columns]);
                break;
            
            default:
                $this->columns[$name] = !$this->columns[$name];
                session(['saleColumns' => $this->columns]);
                break;
        }
            
        
        
    }

  

    public function verifyReceipt(Sale $sale){
        $sale->verify_payment_receipt = 1;
        $sale->verify_payment_receipt_by = auth()->user()->id;
        $sale->verify_payment_receipt_date = Carbon::now();
        $sale->save();
        $this->dispatchBrowserEvent('toast',['title' =>' has verificado el pago.']);
     
     }
}
