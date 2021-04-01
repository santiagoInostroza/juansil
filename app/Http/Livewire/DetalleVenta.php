<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Http\Controllers\Admin\SaleController;

class DetalleVenta extends Component
{
    public $venta;
    public $items;
    public $total;
    public $eliminados;
    public $venta_id;
    //cliente _id se le pasa cuando viene desde una vista de cliente para que aparezca seleccionado
    public $cliente_id;



    public $delivery;
    public $payment_status;
    public $delivery_date;
    public $tiene_comentarios;
    public $payment_amount;
    public $delivery_stage;
    public $search;
    public $customer_id;
    public $customer_name;
    public $date;




    protected $listeners = [
        'eliminarItem' => 'eliminarItem',
        'actualizar' => 'actualizar',
        'guardarProducto' => 'guardarProducto',
        'setCustomerId'
    ];

    public function setCustomerId($id,$nombre)
    {
        $this->customer_id = $id;
        $this->customer_name = $nombre;
    }
    

    public function render(){
        return view('livewire.detalle-venta',[
            'customers'=> Customer::pluck('name','id'),
            'directions'=> Customer::pluck('direccion','id'),
            ]);
    }
    
    public function mount(){

        
        if(isset($this->venta)){
            $this->venta_id=$this->venta->id;
            $this->total =$this->venta->total;
            foreach ($this->venta->sale_items as $item) {
                $this->items[] = [
                    'item_id' => $item->id,
                    'sale_id' => $this->venta_id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'cantidad' => $item->cantidad,
                    'cantidad_por_caja' => $item->cantidad_por_caja,
                    'cantidad_total' => $item->cantidad_total,
                    'precio' => $item->precio,
                    'precio_por_caja' => $item->precio_por_caja,
                    'precio_total' => $item->precio_total,
                ];
            }
            $this->delivery = $this->venta->delivery;
            $this->payment_status = $this->venta->payment_status;
            $this->delivery_date = $this->venta->delivery_date;
            $this->payment_amount = $this->venta->payment_amount;
            $this->delivery_stage = $this->venta->delivery_stage;
            $this->tiene_comentarios =($this->venta->comments != "")? 1: 0;
            $this->customer_id = $this->venta->customer_id;
            $this->customer_name =  $this->venta->customer->name;
            $this->date=$this->venta->date;

        }else{
            $this->venta_id='0';
            $this->items[] = [
                'item_id' => "0",
                'sale_id' =>$this->venta_id,
                'product_id' => '',
                'product_name' => '',
                'cantidad' => '',
                'cantidad_por_caja' =>'',
                'cantidad_total' =>'',
                'precio' =>'',
                'precio_por_caja' => '',
                'precio_total' =>'',
            ];
            $this->delivery = 0;
            $this->payment_status = '1';
            $this->tiene_comentarios = 0;
            $this->delivery_stage = 0;
            $this->delivery_date = $this->dateNextDelivery();
            $this->customer_id =request()->cliente_id;
            // $this->customer_name =request()->cliente_id;
            $this->date=Carbon::now()->toDateString();
        }
        $this->search='1';
    }

   
    
      
 public $prueba;
    public function agregarItem(){
        $agregar = true;
        foreach ($this->items as $value) {
            foreach ($value as $key => $value) {
                if($value ==""){
                   $this->prueba= $key;
                    $agregar = false;
                    break;
                }
            }
        }
        if ($agregar) {
            $this->items[] = [
                'item_id' => '0',
                'sale_id' => $this->venta_id,
                'product_id' => '',
                'cantidad' => '',
                'cantidad_por_caja' =>'',
                'cantidad_total' =>'',
                'precio' =>'',
                'precio_por_caja' => '',
                'precio_total' =>'',
            ];
        }
    }



    public function eliminarItem($id,$item_id)
    {
        $this->eliminados[]=$item_id;
        unset($this->items[$id]);
        $this->actualizarTotal();
    }

    public function actualizar($indice, $product_id, $cantidad, $cantidad_por_caja, $cantidad_total, $precio, $precio_por_caja, $precio_total)
    {
        $this->items[$indice]['product_id'] = $product_id;
        $this->items[$indice]['cantidad'] = $cantidad;
        $this->items[$indice]['cantidad_por_caja'] = $cantidad_por_caja;
        $this->items[$indice]['cantidad_total'] = $cantidad_total;
        $this->items[$indice]['precio'] = $precio;
        $this->items[$indice]['precio_por_caja'] = $precio_por_caja;
        $this->items[$indice]['precio_total'] = $precio_total;

        $this->actualizarTotal();
    }

    public function actualizarTotal()
    {
        try {
            $total = 0;
            foreach ($this->items as $value) {
                $total += $value['precio_total'];
            }
            $this->total =$total;
        } catch (\Throwable $th) {
        }
    }

    public function dateNextDelivery()
    {
        $proxMartes = new Carbon('next tuesday');
        $proxViernes = new Carbon('next friday');

        if($proxMartes->diffInDays(Carbon::now()->toDateString())< $proxViernes->diffInDays(Carbon::now()->toDateString())){
            $fecha =  $proxMartes;
        }else{
            $fecha =  $proxViernes;
        }
       return $fecha->toDateString();
    }



   
}
