<?php

namespace App\Http\Livewire\Admin\Purchases;

use App\Http\Controllers\Admin\StockController;
use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Livewire\WithPagination;
use App\Models\PurchasePrice;
use App\Http\Controllers\helper;
use Illuminate\Support\Facades\Auth;

class Index extends Component{

    // use WithPagination;
    public $openShowDetails = false;
    public $openNewPurchase = false;
    public $openAddItem = false;
    
    public $purchase_selected;
    
    public $search;
    
    public $suppliers;
    public $products;
    
    public $supplier_id;
    public $fecha_compra;
    public $total;
    public $comments;

    public $product_id;
    public $cantidad;
    public $cantidad_por_caja;
    public $cantidad_total;
    public $precio;
    public $precio_por_caja;
    public $precio_total;

    public $validar;//si es 1 valida items, si es 2 valida la compra

    protected $listeners= ['addItem'];

    protected function rules(){
        if($this->validar == 1){
            return [
                'product_id' => 'required|numeric|min:0|not_in:0',
                'cantidad' => 'required|numeric|min:0|not_in:0',
                'cantidad_por_caja' => 'required|numeric|min:0|not_in:0',
                'cantidad_total' => 'required|numeric|min:0|not_in:0',
            
                'precio' => 'required|numeric|min:0|not_in:0',
                'precio_por_caja' => 'required|numeric|min:0|not_in:0',
                'precio_total' => 'required|numeric|min:0|not_in:0',
            ];
        }else if($this->validar == 2){
            return[
                'supplier_id' => 'required|numeric|min:0|not_in:0',
                'fecha_compra' => 'required|date',

            ];
        }
        
    }

    protected $messages = [
   
        'product_id.required' => 'Selecciona producto.',
        'product_id.numeric' => 'Selecciona producto.',
        'product_id.min' => 'Revisa.',
        'product_id.not_in' => 'Selecciona producto.',

        'supplier_id.required' => 'Selecciona Proveedor.',
        'supplier_id.numeric' => 'Selecciona Proveedor.',
        'supplier_id.min' => 'Revisa.',
        'supplier_id.not_in' => 'Selecciona Proveedor.',
        
        'fecha_compra.required' => 'Selecciona Fecha.',

        'cantidad.required' => 'Ingresa cantidad.',
        'cantidad.numeric' => 'Ingresa valor numerico.',
        'cantidad.min' => 'Revisa.',
        'cantidad.not_in' => 'Ingresa cantidad valida.',

        'cantidad_por_caja.required' => 'Ingresa cantidad por caja.',
        'cantidad_por_caja.numeric' => 'Ingresa valor numerico.',
        'cantidad_por_caja.min' => 'Revisa.',
        'cantidad_por_caja.not_in' => 'Ingresa cantidad valida.',
       
        'cantidad_total.required' => 'Ingresa cantidad total.',
        'cantidad_total.numeric' => 'Ingresa valor numerico.',
        'cantidad_total.min' => 'Revisa.',
        'cantidad_total.not_in' => 'Ingresa cantidad valida.',
       
        'precio.required' => 'Ingresa precio.',
        'precio.numeric' => 'Ingresa valor numerico.',
        'precio.min' => 'Revisa.',
        'precio.not_in' => 'Ingresa cantidad valida.',

        'precio_por_caja.required' => 'Ingresa precio por caja.',
        'precio_por_caja.numeric' => 'Ingresa valor numerico.',
        'precio_por_caja.min' => 'Revisa.',
        'precio_por_caja.not_in' => 'Ingresa cantidad valida.',

        'precio_total.required' => 'Ingresa precio total.',
        'precio_total.numeric' => 'Ingresa valor numerico.',
        'precio_total.min' => 'Revisa.',
        'precio_total.not_in' => 'Ingresa cantidad valida.',
        
    ];


  
    
    public function updatingSearch(){
        // $this->resetPage();
    }

    public function mount(){
        $this->suppliers =  Supplier::all();
        $this->products =  Product::with('image')->get();
        $this->fecha_compra =Carbon::now()->locale('es')->timezone('America/Santiago')->format('Y-m-d');

     
        if (session('compra.supplier_id')) {
           $this->supplier_id = session('compra.supplier_id');
        }
        if (session('compra.fecha_compra')) {
           $this->supplier_id = session('compra.fecha_compra');
        }
        if (session('compra.total')) {
           $this->total = session('compra.total');
        }
        if (session('compra.comments')) {
           $this->comments = session('compra.comments');
        }
      
    }
    
    public function render(){
          //session()->forget('compra');
        $purchases = Purchase::join('suppliers','suppliers.id','=','purchases.supplier_id')
        ->leftJoin('users','users.id','=','purchases.user_created')
        ->where('suppliers.name','like','%'. $this->search .'%')
        ->orWhere('total','like','%'. $this->search .'%')
        ->orWhere('fecha','like','%'. $this->search .'%')
        ->orWhere('comments','like','%'. $this->search .'%')
        ->orWhere('users.name','like','%'. $this->search .'%')
        ->select('purchases.*')
        ->orderBy('id','desc')
        ->paginate(25);
        return view('livewire.admin.purchases.index',compact('purchases'));
    }

    public static function fecha($fecha){
        return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es');
        // return Carbon::createFromFormat('Y-m-d', $fecha)->locale('es')->timezone('America/Santiago');
    }

    public function showPurchase(Purchase $purchase){
        $this->purchase_selected= $purchase;
        $this->openShowDetails = true;
    }
    public function newPurchase(){
        $this->openNewPurchase = true;
       
    }

    public function addItem(){
        $this->validar = 1;
        $this->validate();

        $items = [];
        if (session('compra.items')) {
           $items = session('compra.items');
        }

        $product = Product::where('id',$this->product_id)->first();

        $items[]=[
            'product_id' => $this->product_id,
            'product_name' => $product->name,
            'image' => $product->image->url,
            'cantidad' => $this->cantidad,
            'cantidad_por_caja' => $this->cantidad_por_caja,
            'cantidad_total' => $this->cantidad_total,
            'precio' => $this->precio,
            'precio_por_caja' => $this->precio_por_caja,
            'precio_total' => $this->precio_total,
        ];
        session(['compra.items' => $items]);

        
        
        $total = 0;
        foreach (session('compra.items') as  $value) {
            $total += $value['precio_total'];
        }
        $this->total = $total;
        session([
            'compra.total' => $total
        ]); 
            
        $this->reset('product_id','cantidad','cantidad_por_caja','cantidad_total','precio','precio_por_caja','precio_total');
        $this->openAddItem = false;
    }

    public function deleteItem($itemId){
        // session()->flush();
        session()->pull('compra.items.' . $itemId, 'default');
        if (session('compra.items')) {
            $total = 0;
            foreach (session('compra.items') as  $value) {
                $total += $value['precio_total'];
            }
            session([
                'compra.total' => $total
            ]);
        }else{
            session()->forget(['compra', 'items']);
            session()->forget(['compra', 'total']);
            session()->forget('compra');
        }
    }

    public function eliminarSesionVenta(){
        session()->forget('venta');
    }

    public function deleteSession()
    {
        session()->forget('compra');
    }

    public function updatedComments ($value){
        session([
            'compra.comments' => $value,
        ]);
    }
    public function updatedFechaCompra ($value){
        session([
            'compra.fecha_compra' => $value,
        ]);

    }
    public function updatedSupplierId ($value){
        session([
            'compra.supplier_id' => $value,
        ]);
    }

    public function updatedProductId ($value){
        $product= Product::find($value);
        $this->cantidad_por_caja = $product->formato;
    }

    public function save(){

        $this->validar = 2;
        $this->validate();
        if (session('compra.items')) {

            $purchase =new Purchase();
            $purchase->supplier_id = $this->supplier_id;
            $purchase->total = $this->total;
            $purchase->fecha = $this->fecha_compra;
            $purchase->comments = $this->comments;
            $purchase->user_created = Auth::id();
            $purchase->save();

            

            foreach (session('compra.items') as $item) {
                $purchaseItem = new PurchaseItem();
                $purchaseItem->purchase_id=$purchase->id; 
                $purchaseItem->product_id=$item['product_id']; 
                $purchaseItem->cantidad=$item['cantidad']; 
                $purchaseItem->cantidad_por_caja=$item['cantidad_por_caja']; 
                $purchaseItem->cantidad_total=$item['cantidad_total']; 
                $purchaseItem->precio=$item['precio']; 
                $purchaseItem->precio_por_caja=$item['precio_por_caja']; 
                $purchaseItem->precio_total=$item['precio_total']; 
                $purchaseItem->save();

                $product = Product::find($item['product_id']);
                $product->stock += $item['cantidad_total'];
                $product->save();

       
                $productPurchasePrice = new PurchasePrice();
                $productPurchasePrice->product_id = $item['product_id'];
                $productPurchasePrice->precio = $item['precio'];
                $productPurchasePrice->precio_por_caja = $item['precio_por_caja'];
                $productPurchasePrice->stock = $item['cantidad_total'];
                $productPurchasePrice->cantidad = $item['cantidad_total'];
                $productPurchasePrice->fecha = $this->fecha_compra;
                $productPurchasePrice->purchase_id = $purchase->id;
                $productPurchasePrice->save();
            }
            
            session()->forget('compra');
            $this->openNewPurchase= false;
            
            $this->reset('comments');
            $this->dispatchBrowserEvent('alerta', [
                'msj' =>  "Compra " . $purchase->id ." creada !! " . $purchase->supplier->name . " Total ". number_format($purchase->total,0,',','.'),
                'icon' => 'success',
                'title' => "Compra creada",
            ]); 
        }else{
            $this->dispatchBrowserEvent('alerta', [
                'msj' =>  "Debes ingresar productos antes de generar la compra",
                'icon' => 'error',
                'title' => "No puedes agregar compra",
            ]); 
        }

        
    }

    public function deletePurchase(Purchase $purchase){
       $stock = new StockController();
       $stock->restaurarStock($purchase);
       $purchase->delete();

       $this->dispatchBrowserEvent('alerta', [
        'msj' =>  "Compra " . $purchase->id ." eliminada !! " . $purchase->supplier->name . " Total ". number_format($purchase->total,0,',','.'),
        'icon' => 'success',
        'title' => "Compra Eliminada",
    ]); 

    }


   
}
