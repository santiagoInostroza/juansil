<?php

namespace App\Http\Livewire\Productos;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class Orders extends Component{

    public $search;
    public $editRow;
    public $rowSelected;
    public $showInfo;
    public $showInfoTrue;
    public $editRowVerify;
    public $orderBy;
    public $direction;
    public $openAddNew;

    protected $listeners = ['deleteItemSure'];


    public function mount(){
        $this->orderBy="date";
        $this->direction="desc";
        $this->openAddNew = false;
        $this->editRowVerify = true;
    }

    public function updatedOpenAddNew(){
        if ($this->openAddNew) {
           $this->editRowVerify = false;
        }
    }



    public function render(){


        $collection = Sale::join('customers','customers.id','=','sales.customer_id')->where('customers.email',auth()->user()->email)
            // ->where('name', 'like', '%'. $this->search . '%')->orWhere('id', '=',  $this->search)
            ->select('sales.*')
            ->orderBy($this->orderBy, $this->direction)
            ->get();

        foreach ($collection as  $item) {
            $this->editRow[$item->id] = false;
        }

        if($this->editRowVerify){
            if ( $this->rowSelected) {
                $this->editRow[$this->rowSelected] = true;

               
            }
        
        }

        $items= collect(['name','name2']);


        return view('livewire.productos.orders',compact('collection','items'));
    }

    public function editRowTrue($user_id){
        $this->editRow[$this->rowSelected] = false;
        $this->editRow[$user_id] = true;
        $this->rowSelected = $user_id;
        $this->editRowVerify = true;
    }

    public $deleteItemId;
    public function deleteItem($item_id){
        $this->deleteItemId = $item_id;
        $this->dispatchBrowserEvent('alertaEliminar', [
            'msj' =>  "Se eliminara permanentemente!!",
            'icon' => 'warning',
            'title' => "¿Deseas eliminar?",
            'delete'=> "deleteItemSure"
        ]); 
        
       
    }

    public function isShowInfo($sale_id){
        if($this->showInfo == $sale_id){
            $this->showInfo = null;
        }else{
            $this->showInfo = $sale_id;
        }
    }

    public function deleteItemSure(){
        // $permission= Permission::find($this->deleteItemId);
        // $permission->delete();

        $this->dispatchBrowserEvent('alerta', [
            'msj' =>  $this->deleteItemId . " Eliminado para siempre!!",
            'icon' => 'success',
            'title' => "Eliminado",
          
        ]); 
    }

    
    public function editName($item_id, $name){
        // $permission = Permission::find($item_id);
        // $permission->name = $name;
        // $permission->save();
       
    }

    // public $namePermission;
    // public $descriptionPermission;

    public function addRol(){

        // $permission = Permission::create([
        //     'name' => $this->namePermission,
        //     'description' => $this->descriptionPermission,
        // ]);
        $this->openAddNew = false;
       
        
    }
}
