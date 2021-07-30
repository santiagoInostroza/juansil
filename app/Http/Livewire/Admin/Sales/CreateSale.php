<?php

namespace App\Http\Livewire\Admin\Sales;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\SaleItem;
use App\Models\PurchasePrice;
use Illuminate\Support\Facades\Auth;


class CreateSale extends Component{
    public $search;

    public $fecha;

    public $open = false;
    public $open_add_item = false;
    public $open_mod_item = false;
    public $open_list = true;

    public $selected_product;

    public $customerId;
    public $selectedCustomer;

   

    public $product_id;
    public $image;
    public $name;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $precio_total;

    public $tagId;
    public $tagName ="";
    public $item_id;

    public $delivery=false;
    public $fecha_entrega;
    public $valor_despacho;
    public $delivered;

    public $estado_pago=1;
    public $comentario;
    public $openComentario = false;
    public $abono;

    protected $listeners = [
        'seleccionar',
        'setCustomerId'
    ];

    protected $rules = [
        'cantidad' => 'required|numeric|min:0|not_in:0',
        'cantidad_por_caja' => 'required|numeric|min:0|not_in:0',
       
        'precio' => 'required|numeric|min:0|not_in:0',
        'precio_por_caja' => 'required|numeric|min:0|not_in:0',
      
    ];

    protected $messages = [
        'cantidad.required' => 'Ingresar cantidad.',
        'cantidad.numeric' => 'Ingresar valor numerico.',
        'cantidad.min' => 'Revisar.',
        'cantidad.not_in' => 'Ingresar cantidad valida.',

        'cantidad_por_caja.required' => 'Ingresar cantidad por caja.',
        'cantidad_por_caja.numeric' => 'Ingresar valor numerico.',
        'cantidad_por_caja.min' => 'Revisar.',
        'cantidad_por_caja.not_in' => 'Ingresar cantidad valida.',
       
        'precio.required' => 'Ingresar precio.',
        'precio.numeric' => 'Ingresar valor numerico.',
        'precio.min' => 'Revisar.',
        'precio.not_in' => 'Ingresar cantidad valida.',

        'precio_por_caja.required' => 'Ingresar precio por caja.',
        'precio_por_caja.numeric' => 'Ingresar valor numerico.',
        'precio_por_caja.min' => 'Revisar.',
        'precio_por_caja.not_in' => 'Ingresar cantidad valida.',
        
    ];

    public function mount(){
       $this->fecha = Carbon::now()->toDateString();
       $this->fecha_entrega = Carbon::now()->tomorrow()->toDateString();
    }

    public function updatedTagId(){
        $this->search = "";
        if($this->tagId>0){
            $tag = Tag::find($this->tagId);
            $this->tagName = $tag->name;
        }else{
            $this->tagName = "";
        }
    }
    public $msj ="";

   
    public function save(){

        $total =($this->valor_despacho>0)? $this->valor_despacho + session('venta.total'): session('venta.total');

        $payment_amount = 0;
        $pending_amount = 0;
        if($this->estado_pago == 1){
            $payment_amount=0;
            $pending_amount = $total;
        }else if($this->estado_pago == 2){
            $payment_amount = $this->abono;
            $pending_amount = $total - $this->abono;
        }else if($this->estado_pago == 3){
            $payment_amount=$total;
            $pending_amount = 0;
        }

        $payment_date =($this->estado_pago == 3)? Carbon::now()->toDateString(): null;
        $delivery_date = ($this->delivery)? $this->fecha_entrega: null;
        $date_delivered = ($this->delivered)? $delivery_date : null ;
        $delivered_user=($this->delivered)? Auth::user()->id:null;
        $delivery_value=($this->delivery)? $this->valor_despacho: null;

        $sale = Sale::create([
            'customer_id' => $this->customerId,
            'total' => $total,
            'date' => $this->fecha,
            'payment_amount' => $payment_amount,
            'payment_status' => $this->estado_pago,
            'pending_amount' => $pending_amount,
            'payment_date' => $payment_date,
            'delivery' => $this->delivery,
            'delivery_date' => $delivery_date,
            'date_delivered' => $date_delivered,
            'delivery_stage' => $this->delivered,
            'comments' => $this->comentario,
            'user_created' => Auth::user()->id,
            'total_cost' => 0,
            'delivered_user' => $delivered_user,
            'delivery_value' => $delivery_value,
        ]);

        $total_cost = 0;

        foreach (session('venta.items') as $key => $item) {


            $producto_general = Product::find($item['product_id']);
            $stock = $producto_general->stock;
            $nuevoStock = $stock - $item['cantidad_total'];

            $producto_general->stock = $nuevoStock;
            $producto_general->save();

            $go = true;
            $cantidad_restante = 0;
            $suma_costo = 0;
            $costo=0;
            $costo_final = 0;

            $vueltas = 0;
            
            try {//intenta obtener el valor de costo del producto
                do {
                    $producto = PurchasePrice::where('product_id', $item['product_id'])->where('stock', '>', 0)->orderBy('created_at', 'asc')->first();    
                    $cantidad = ($cantidad_restante == 0) ? $item['cantidad_total'] : $cantidad_restante ;
                    
                    $costo = $producto->precio;
                    $costo2 = $producto->precio;
                    $cantidad_a_multiplicar = 0;
                    if($producto->stock >= $cantidad){//alcanza para cubrir el stock necesitado
                        $stock = $producto->stock;
                        $producto->stock = $stock - $cantidad;
                        $go = false;
                        $cantidad_a_multiplicar = $cantidad;
                    }else{ // no alcanza el stock, es necesario obtener otro producto para ocupar su stock
                        $cantidad_restante =  $cantidad - $producto->stock;
                        $cantidad_a_multiplicar = $producto->stock;
                        $producto->stock = 0; 
                    }
                    $producto->save();
                    $total_costo = $cantidad_a_multiplicar * $costo;
                    $suma_costo += $total_costo;
                    $vueltas++;
                } while ($go); 

                $costo_final =$suma_costo / $item['cantidad_total'];
                $total_cost += $suma_costo;

            } catch (\Throwable $th) { //si encuentra un costo pero el stock no es suficiente, guarda todos los costos con el valor que encontro, si no encuentra ni un costo guarda el valor del costo al valor del precio venta
                if($vueltas>0){
                    $costo = $costo2;
                    $this->msj.= "Stock insuficiente de '$producto_general->name'.\n";
                }else{
                    $costo_final = $item['precio'];
                    $total_cost = $item['precio'] * $item['cantidad_total']; 
                    $this->msj.= "No se encontro stock de '$producto_general->name'.\n";
                }
               
            }

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['product_id'],
                'cantidad' => $item['cantidad'],
                'cantidad_por_caja' => $item['cantidad_por_caja'],
                'cantidad_total' => $item['cantidad_total'],
                'precio' => $item['precio'],
                'precio_por_caja' => $item['precio_por_caja'],
                'precio_total' => $item['precio_total'],
                'costo' => $costo_final,
            ]);
        }

        $sale->total_cost = $total_cost;
        $sale->save();
        $this->open=false;
        $this->emitUp('render');

       
       
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  $this->msj,
            'icon' => 'success',
            'title' => "Venta " . $sale->id ." creada !! " . $this->selectedCustomer->name . "' Total '". $sale->total,
        ]); 
        $this->reset();
        $this->eliminarSesionVenta();

    }
   

    public function render(){
        if($this->tagId>0){
            $products = Product::join('product_tag', 'product_tag.product_id','=','products.id')
            ->where('products.name', 'like', '%' . $this->search . '%')
            ->where('product_tag.tag_id', '=',  $this->tagId)
            ->select('products.*')
            ->orderBy('products.name','asc')
            ->get();
        }else{
            $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name','asc')
            ->get();
        }

        $tags = Tag::orderBy('name','asc')->get();
        
        return view('livewire.admin.sales.create-sale', compact('products','tags'));
    }

    public function setCustomerId($customerId){
        $this->customerId = $customerId;
        $this->selectedCustomer = Customer::find($this->customerId);
    }

    public function seleccionar($pid){
        $this->product_id = $pid;
        $this->selected_product = Product::find($this->product_id);
        $this->cantidad_por_caja = $this->selected_product->formato;
        $this->name =  $this->selected_product->name;
        $this->image =  $this->selected_product->image->url;
        $this->search = $this->selected_product->name;
        $this->open_list = false;
    }


    public function addItem(){
        $this->validate();

        $this->addToSale();

        $this->open_add_item = false;
        $this->open_mod_item = false;
        $this->open_list = true;

        $this->reset('cantidad','selected_product');
    }

    public function addToSale(){
        $items = [];
        if (session()->has('venta.items')) {
            $items = session('venta.items');
        }

        $items[] =
            [
                'product_id' => $this->product_id,
                'product_name' => $this->name,
                'image' => $this->image,
                'cantidad' => $this->cantidad,
                'cantidad_por_caja' => $this->cantidad_por_caja,
                'cantidad_total' => $this->cantidad_total,
                'precio' => $this->precio,
                'precio_por_caja' => $this->precio_por_caja,
                'precio_total' => $this->precio_total,
            ];

        session([
            'venta.items' => $items
        ]);

        $total = 0;
        foreach (session('venta.items') as  $value) {
            $total += $value['precio_total'];
        }


        session([
            'venta.total' => $total
        ]);
    }

    


    public function open_add_item(){
        $this->reset(['selected_product','search','cantidad','cantidad_por_caja','cantidad_total','precio','precio_por_caja','precio_total']);
        $this->open_list = true;
        $this->modItem = false;
        $this->open_add_item = true;
        $this->search ="";

    }

  

    public $modItem = false;
    
    public function open_mod_item($id){
        $this->modItem = true;
        $this->item_id = $id;
        $this->product_id = session('venta.items')[$this->item_id]['product_id'];
        $this->selected_product = Product::find($this->product_id);
        $this->name =  $this->selected_product->name;
        $this->search =  $this->selected_product->name;
        $this->image =  $this->selected_product->image->url;
        $this->cantidad = session('venta.items')[$this->item_id]['cantidad'];
        $this->cantidad_por_caja = session('venta.items')[$this->item_id]['cantidad_por_caja'];
        $this->cantidad_total = session('venta.items')[$this->item_id]['cantidad_total'];
        $this->precio = session('venta.items')[$this->item_id]['precio'];
        $this->precio_por_caja = session('venta.items')[$this->item_id]['precio_por_caja'];
        $this->precio_total = session('venta.items')[$this->item_id]['precio_total'];
        

        $this->open_add_item = true;
        $this->open_list = false;
    }

    public function modItem(){
        $this->validate();
        $items = [];
        if (session()->has('venta.items')) {
            $items = session('venta.items');
        }

        $items[$this->item_id] =
            [
                'product_id' => $this->product_id,
                'product_name' => $this->name,
                'image' => $this->image,
                'cantidad' => $this->cantidad,
                'cantidad_por_caja' => $this->cantidad_por_caja,
                'cantidad_total' => $this->cantidad_total,
                'precio' => $this->precio,
                'precio_por_caja' => $this->precio_por_caja,
                'precio_total' => $this->precio_total,
            ];

        session([
            'venta.items' => $items
        ]);

        $this->total = 0;
        foreach (session('venta.items') as  $value) {
            $this->total += $value['precio_total'];
        }


        session([
            'venta.total' => $this->total
        ]);


        $this->open_add_item = false;
        $this->open_mod_item = false;
        $this->open_list = true;
    }

    public function deleteItem($itemId){
        // session()->flush();
        session()->pull('venta.items.' . $itemId, 'default');
        if (session('venta.items')) {
            $total = 0;
            foreach (session('venta.items') as  $value) {
                $total += $value['precio_total'];
            }
            session([
                'venta.total' => $total
            ]);
        }else{
            session()->forget(['venta', 'items']);
            session()->forget(['venta', 'total']);
            session()->forget('venta');
        }
    }

    public function eliminarSesionVenta(){
        session()->forget('venta');
    }




  

 
}
