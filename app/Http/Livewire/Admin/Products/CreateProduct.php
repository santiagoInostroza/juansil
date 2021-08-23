<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

use App\Models\Category;
use App\Models\SalePrice;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class CreateProduct extends Component{
    use WithFileUploads;

    
    public $photo;
    public $isActive = true;
    public $name;
    public $formato;
    public $stock_min;
    public $brand;
    public $category;
    public $etiquetas;
    public $salePrices;
    public $special_sale_price;
    public $description;

    protected $rules=[
        'photo' => 'image|max:1024', // 1MB Max
        'name'=>'required',
        'brand'=>'required',
        'category'=>'required',
        'etiquetas'=>'required',
    ];

    protected $messages=[
        'photo.image' =>"Selecciona una imágen",
        'photo.max:1024' =>"Imágen no puede pesar más de 1 mega",
        'name.required' =>"Ingresa un nombre para el producto",
        'brand.required' =>"Selecciona marca",
        'category.required' =>"Selecciona categoría",
        'etiquetas.required' =>"Seleccionar por lo menos 1 etiqueta",
    ];

  

    public function save(){

        $this->validate();

       
        $product = new Product();
        $product->name = $this->name;
        $product->slug = Str::slug( $this->name);
        $product->formato =  $this->formato;
        $product->description =  $this->description;
        $product->stock_min =  $this->stock_min;
        $product->status =  $this->isActive;
        $product->category_id =  $this->category;
        $product->brand_id =  $this->brand;
        $product->special_sale_price =  $this->special_sale_price;       
        $product->save();
        $product->tags()->attach($this->etiquetas);

        if($this->photo){
            $url =  $this->photo->store('products');
            $product->image()->create([
                'url' => $url
            ]);
        }

        foreach ($this->salePrices as  $price) {
            $salePrice = new SalePrice();
            $salePrice->product_id = $product->id;
            $salePrice->quantity = $price['quantity'];
            $salePrice->price = $price['price'];
            $salePrice->total_price = $price['total_price'];
            $salePrice->save();
        }

        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Producto $product->name se ha creado con exito",
            'icon' => 'success',
            'title' => "Producto creado!!",
        ]); 

        $this->reset();



    }

    public function render(){
        $brands= Brand::all();
        $categories= Category::all();
        $tags= Tag::all();
        return view('livewire.admin.products.create-product',compact('brands','categories','tags'));
    }


    public $producto;
    public $precio_unitario;
    public $precio_total;
    public $cantidad;
    public $openAgregarPrecios = false;

    public function mount(){
        if(isset(request()->producto->salePrices)){
            foreach (request()->producto->salePrices as $p) {
                $this->salePrices[$p->quantity] = [
                    'quantity'=>$p->quantity,
                    'price'=>$p->price,
                    'total_price'=>$p->total_price,
                    'special_price'=>$p->special_price,
                    'check'=>true,
                ];
            }
        }
    }

    public function agregarPrecio(){
        $this->salePrices[$this->cantidad] = [
            'quantity'=>$this->cantidad,
            'price'=>$this->precio_unitario,
            'total_price'=>$this->precio_total,
            'check'=>true,
        ];

        asort($this->salePrices);
 

        $this->cantidad='';
        $this->precio_unitario='';
        $this->precio_total='';
        $this->special_price='';

        $this->openAgregarPrecios = false;
       
    }

    public function eliminarPrecio($cantidad){
        $this->salePrices[$cantidad]['check']=false;
    }

    public function restaurarPrecio($cantidad){
        $this->salePrices[$cantidad]['check']=true;
    }
}