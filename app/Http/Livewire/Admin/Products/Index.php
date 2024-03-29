<?php

namespace App\Http\Livewire\Admin\Products;

use App\Http\Controllers\Admin\BrandController;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SalePrice;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\TagController;




class Index extends Component{
    
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $sort = "id";
    public $direction = "desc";

    public $openBrand = false;
    public $showCreateProduct = false;
    public $openChangePhoto = false;
    public $productStatus;
    public $onlyStock = false;
    public $numberOfProductsToDisplay;

    public $editRow;
    public $editRowVerify = true;
    public $rowTrue;

    protected $listeners = ['refreshComponent' => '$refresh','closeCreateProduct'];


    public function closeCreateProduct(){
        $this->showCreateProduct = false;
    }

    // public function updatingOnlyStock(){
    //     $this->editRowVerify = true;
    // }

    public function mount(){
          $this->numberOfProductsToDisplay = (session('numberOfProductsToDisplay')) ?session('numberOfProductsToDisplay') :10;
       

    }


    public function updatedNumberOfProductsToDisplay(){
        session(['numberOfProductsToDisplay' => $this->numberOfProductsToDisplay]);
     
    }
  



    public function render(){
        $str = explode(' ', $this->search);

        $query = Product::with(['salePrices','category','tags','brand','image'])
        // ->where('name','like','%'. $this->search . '%')
        ->where(function($query) use($str) {
            foreach($str as $s) {
                $query = $query->where('name','like',"%" . $s . "%");
            }
        })
        ->orderBy($this->sort,$this->direction);
        if($this->onlyStock){
            $products= $query->where('stock','>',0);
        }
        $products = $query->paginate($this->numberOfProductsToDisplay);

        $brands= Brand::orderBy('name','asc')->get();
        $categories= Category::orderBy('name','asc')->get();
        $tags= Tag::orderBy('name','asc')->get();



        
        foreach ($products as  $product) {
            $this->editRow[$product->id] = false;
        }
            // $this->editRowVerify = false;
        if($this->editRowVerify){
            if ( $this->rowTrue) {
                $this->editRow[$this->rowTrue] = true;
            }
        }
       

        return view('livewire.admin.products.index', compact('products','brands','categories','tags'));
    }

    public function openCreateProduct(){
        $this->editRow[$this->rowTrue] =false;
        $this->editRowVerify = false;
        $this->showCreateProduct = true;
    }

    
    public function editRowTrue($product_id){
        $this->editRow[$this->rowTrue] = false;
        $this->editRow[$product_id] = true;
        $this->rowTrue = $product_id;
        $this->editRowVerify = true;
    }
    public function editRowFalse($product_id){
       $this->editRow[$product_id] = false;
    }
    public function editOk(){
       $this->editRow[$this->rowTrue] = false;
       $this->editRowVerify = false;
    }

    public function updatingSearch(){
        $this->resetPage();
        // $this->editRowVerify = true;
    }
    
    public function order($sort){
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }      
    }

    public function saveName($product_id , $name){
        $product = Product::find($product_id);
        $product->name = $name; 
        $product->slug = Str::slug($name); 
        $product->save();
    }
    
    public function saveBrand($product_id , $brand_id){
        $product = Product::find($product_id);
        $product->brand_id = $brand_id; 
        $product->save();
    }
    
    public function saveCategoria($product_id , $category_id){
        $product = Product::find($product_id);
        $oldCategory = $product->category->name;
        
        $product->category_id = $category_id; 
        $product->save();
        
        $category = Category::find($category_id);
        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  "Se ha cambiado '$oldCategory' por '$category->name'",
            'icon' => 'success',
            'title' => "La categoría ha sido cambiada",
        ]); 
    }

    public function saveFormato($product_id , $value){
       
        $product = Product::find($product_id);
        $oldValue = $product->formato;
        $product->formato = $value; 
        $product->save();
    }


    public function setStatus($product_id, $valor){
        $product = Product::find($product_id);
        $product->status = $valor; 
        $product->save();
       
    }

    public function setStockMin($product_id, $valor){
        $product = Product::find($product_id);
        $product->stock_min = $valor; 
        $product->save();
       
    }

    public function setSpecialSalePrice($product_id, $valor){
        $product = Product::find($product_id);
        $product->special_sale_price = $valor; 
        $product->save();
       
    }
    public function setSalePrice($price_id, $quantity, $valor, $valor_por_caja){
        $price = SalePrice::find($price_id);
        $price->quantity = $quantity; 
        $price->price = $valor; 
        $price->total_price = $valor_por_caja; 
        $price->save();
       
    }

    public function createSalePrice($product_id, $quantity, $valor, $valor_por_caja){
        $price =  SalePrice::where('product_id',$product_id)->where('quantity',$quantity)->first();
        if(!$price){
            $price = new SalePrice();
            $price->product_id = $product_id; 
        }
        $price->quantity = $quantity; 
        $price->price = $valor; 
        $price->total_price = $valor_por_caja; 
        $price->save(); 
       
    }

    public function removePrice(SalePrice $price){
        $price->delete();  
    }

    public function removeTag( $product_id, $tag_id){
        $product = Product::find($product_id); 
        $product->tags()->detach($tag_id);
        $this->render();
        $product->refresh();
    }


    public function saveTag($product_id, $tag_id){
        if($tag_id>0){

            $product = Product::find($product_id);
            if( !$product->tags->contains('id',$tag_id)){
                $product->tags()->attach($tag_id);
                return true;
            }else{
                return false;
            }
           
        }else{
            return false;
        }
        
       
    }
    
    public function saveNewTag($product_id,$nameTag, $typeTag){
        $tagController= new TagController();
        $tag['name']= $nameTag;
        $tag['type']= $typeTag;

        $tag_id=$tagController->saveNewTag($tag);

        if($tag_id>0){
            $this->saveTag($product_id, $tag_id);
        }else{

        }
    }

    public function saveNewBrand($product_id,$nameBrand){
        $brandController= new BrandController();
        $brand_id=$brandController->saveNewBrand($nameBrand);

        if($brand_id>0){
            $this->saveBrand($product_id, $brand_id);
        }else{

        }
    }

    public function saveDescription($product_id, $description){
        $product = Product::find($product_id);
        $product->description = $description;
        $product->save();
    }

    public $photo0;
    public $product_selected;

    public function changePhoto($product_id){
        $product = Product::find($product_id);
        $this->product_selected = $product;
        $this->openChangePhoto = true;
        
    }

    public function savePhoto(){
        
        if($this->photo0){
            request()->validate([
                'photo0' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            //consigue el nombre
            $url  = $this->photo0->hashName();

            if ($this->product_selected->image) {

                // Elimina imagen existente
                Storage::delete('products/'. $this->product_selected->image->url);
                Storage::delete('products_thumb/' .  $this->product_selected->image->url);

               

                //guarda en products
                // $this->photo0->store('products');


                 // guarda en products
                $manager =  new ImageManager();
                $image1 = $manager->make($this->photo0)->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $image1->encode('webp');
                $image1->save('storage/products/' . $this->product_selected->slug . '.webp');



                if (!Storage::disk('public')->exists('products_thumb')) {
                    Storage::disk('public')->makeDirectory('products_thumb');
                }

                if (!Storage::disk('public')->exists('products_png')) {
                    Storage::disk('public')->makeDirectory('products_png');
                    Storage::disk('public')->makeDirectory('products_png_thumb');
                }
    
                
                // guarda en thumbs
                $image2 = $manager->make($this->photo0)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('webp');
                $image2->save('storage/products_thumb/'. $this->product_selected->slug . '.webp');
    

                // guarda en png
                $image2 = $manager->make($this->photo0)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('png');
                $image2->save('storage/products_png/'. $this->product_selected->slug . '.png');
    

                // guarda en png_thumbs
                $image2 = $manager->make($this->photo0)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('png');
                $image2->save('storage/products_png_thumb/'. $this->product_selected->slug . '.png');

                // guarda en base de datos (ACTUALIZA)
                $this->product_selected->image->update([
                    'url' =>  $this->product_selected->slug . '.webp',
                    'url2' =>  $this->product_selected->slug . '.png',
                ]);
               
                
            } else {

                 // guarda en base de datos (CREA NUEVO)
                $this->product_selected->image()->create([
                    'url' => $this->product_selected->slug . '.webp',
                    'url2' => $this->product_selected->slug . '.png',
                ]);

                if (!Storage::disk('public')->exists('products_thumb')) {
                    Storage::disk('public')->makeDirectory('products_thumb');
                }

                if (!Storage::disk('public')->exists('products_png')) {
                    Storage::disk('public')->makeDirectory('products_png');
                    Storage::disk('public')->makeDirectory('products_png_thumb');
                }

                $manager =  new ImageManager();
                $image1 = $manager->make( $this->photo0 );
                $image1->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image1->encode('webp');
                $image1->save('storage/products/' . $this->product_selected->slug . '.webp');  
        
                // guarda en thumbs
                $image2 = $manager->make($this->photo0);
                $image2->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('webp');
                $image2->save('storage/products_thumb/' . $this->product_selected->slug . '.webp');   


                // guarda en png
                $image2 = $manager->make($this->photo0);
                $image2->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('png');
                $image2->save('storage/products_png/' . $this->product_selected->slug . '.png');   


                // guarda en png_thumbs
                $image2 = $manager->make($this->photo0);
                $image2->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('png');
                $image2->save('storage/products_png_thumb/' . $this->product_selected->slug . '.png');   



            }


        }

        $this->openChangePhoto = false;
        $this->photo0 = "";
    }

  
    public function webpToPng($product_id){
        $product = Product::find($product_id);  
        $url = $product->image->url;   
        
        
        if (!Storage::disk('public')->exists('products_png')) {
            Storage::disk('public')->makeDirectory('products_png');
            Storage::disk('public')->makeDirectory('products_png_thumb');
        }


        $manager =  new ImageManager();
        $image1 = $manager->make( 'storage/products/' . $url)->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image1->encode('png');
        $image1->save( 'storage/products_png/' .  $product->slug . '.png' );  


        $manager =  new ImageManager();
        //   guarda en thumbs           
        $image2 = $manager->make( 'storage/products/' . $url )->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image2->encode('webp');
        $image2->save('storage/products_png_thumb/'  .  $product->slug . '.png'); 
        
        
        
        $product->image->update([
            'url2' =>  $product->slug . '.png',
        ]);


        // Storage::delete('products/'. $url2);
        // Storage::delete('products_thumb/' .  $url2);
        
    }

    public function optimizarImagen($product_id){

        $product = Product::find($product_id);  
        $url = $product->image->url;

        if (strpos($url, 'products/') !== false) {
            $url2 = substr($url, 9 );
        }else{
            $url2=$url;
        }

        $manager =  new ImageManager();
        $image1 = $manager->make( 'storage/products/' . $url2)->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image1->encode('webp');
        $image1->save( 'storage/products/' .  $product->slug . '.webp' );  


        $manager =  new ImageManager();
        //   guarda en thumbs           
        $image2 = $manager->make( 'storage/products/' . $url2 )->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image2->encode('webp');
        $image2->save('storage/products_thumb/'  .  $product->slug . '.webp'); 
        
        
        
        $product->image->update([
            'url' =>  $product->slug . '.webp',
        ]);

        // Storage::delete('products/'. $url2);
        // Storage::delete('products_thumb/' .  $url2);
            
        
    }



    public function optimizarImagenes(){

        $products = Product::all(); 
        foreach ($products as  $product) {
            if ($product->image) {
                $url = $product->image->url;

                if (strpos($url, 'products/') !== false) {
                    $url2 = substr($url, 9 );
                }else{
                    $url2=$url;
                }
            
                $manager =  new ImageManager();
                $image1 = $manager->make( 'storage/products/' . $url2)->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image1->encode('webp');
                $image1->save( 'storage/products/' .  $product->slug . '.webp' );        

                $manager =  new ImageManager();
                //   guarda en thumbs           
                $image2 = $manager->make( 'storage/products/' . $url2 )->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image2->encode('webp');
                $image2->save('storage/products_thumb/' .  $product->slug . '.webp');   
                
                $product->image->update([
                    'url' =>  $product->slug . '.webp',
                ]);

                // Storage::delete('products/'. $url2);
                // Storage::delete('products_thumb/' .  $url2);
            }
            
        }    
    }

    public function guardarImagenes($product_id){
        $product = Product::find($product_id); 
            if ($product->image) {
                $url = $product->image->url;
                return Storage::download('products/' . $url);
            
                // $manager =  new ImageManager();
                // $image1 = $manager->make( 'storage/products/' . $url2)->resize(500, 500, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // });
                // $image1->encode('webp');
                // $image1->save( 'images/products2/' .  $product->slug . '.webp' );                       
               

            }
        
    }
}
