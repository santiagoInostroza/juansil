<?php

namespace App\Http\Livewire;

use stdClass;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;



class DetalleCompra extends Component
{

    public $compra;
    public $items;
    public $total;

    public $purchase_id;

    public $eliminados;



    protected $listeners = [
        'eliminarItemCompra' => 'eliminarItemCompra',
        'actualizar' => 'actualizar',
        'guardarProducto' => 'guardarProducto',
    ];


    public function render()
    {
        return view('livewire.detalle-compra',[
            'nombreProductos' =>Product::pluck('name', 'id'),
        ]);
    }


    public function mount(){


        $this->total = (isset($this->compra)) ? number_format($this->compra->total, 0, ',', '.') : "";
        $this->purchase_id = (isset($this->compra)) ? $this->compra->id : "0";


        if(isset($this->compra)){
            foreach ($this->compra->products as $detalle) {
                $this->items[] = [
                    'purchase_id' => $detalle->pivot->purchase_id,
                    'product_id' => $detalle->pivot->product_id,
                    'item_id' => $detalle->pivot->id,
                    'cantidad' => $detalle->pivot->cantidad,
                    'cantidad_por_caja' => $detalle->pivot->cantidad_por_caja,
                    'cantidad_total' => $detalle->pivot->cantidad_total,
                    'precio' => $detalle->pivot->precio,
                    'precio_por_caja' => $detalle->pivot->precio_por_caja,
                    'total_producto' => $detalle->pivot->total,
    
                ];
            }
        }else{
            $this->items[] = [
              
                'purchase_id' => $this->purchase_id,
                'product_id' => '',
                'item_id' => '0',
                'cantidad' => '',
                'cantidad_por_caja' => '',
                'cantidad_total' => '',
                'precio' => '',
                'precio_por_caja' => '',
                'total_producto' => '',
            ];
        }
        
    }

    public function agregarItemCompra(){
        $agregar = true;

        foreach ($this->items as $fila) {
            foreach ($fila as  $elemento) {
                if ($elemento == "") {
                    $agregar = false;
                    break;
                }
            }
        }

        if ($agregar) {
            $this->items[] = [
                'purchase_id' => $this->purchase_id,
                'product_id' => '',
                'item_id' =>'0',
                'cantidad' => '',
                'cantidad_por_caja' => '',
                'cantidad_total' => '',
                'precio' => '',
                'precio_por_caja' => '',
                'total_producto' => '',
            ];
        }
    }


    public function eliminarItemCompra($id,$item_id)
    {
        $this->eliminados[]=$item_id;
        unset($this->items[$id]);
        $this->actualizarTotal();
    }

    public function actualizar($indice, $product_id, $cantidad, $cantidad_por_caja, $cantidad_total, $precio, $precio_por_caja, $total_producto)
    {
        $this->items[$indice]['product_id'] = $product_id;
        $this->items[$indice]['cantidad'] = $cantidad;
        $this->items[$indice]['cantidad_por_caja'] = $cantidad_por_caja;
        $this->items[$indice]['cantidad_total'] = $cantidad_total;
        $this->items[$indice]['precio'] = $precio;
        $this->items[$indice]['precio_por_caja'] = $precio_por_caja;
        $this->items[$indice]['total_producto'] = $total_producto;

        $this->actualizarTotal();
    }

    public function actualizarTotal()
    {
        try {
            $total = 0;
            foreach ($this->items as $value) {
                $total += $value['total_producto'];
            }

            $this->total =$total;
        } catch (\Throwable $th) {
        }
    }
}
