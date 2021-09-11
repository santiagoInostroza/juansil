<?php

namespace App\Http\Livewire\Admin\Visits;

use Livewire\Component;
use App\Models\UserCount;

class Lista extends Component{
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

       
        
       


        $userCounts = UserCount::orderBy('date','desc')
            ->where('countryName','Chile') 
            ->where('nameNavigator', 'like', '%'. $this->search . '%')
            ->orWhere('id', '=',  $this->search)
            ->orderBy( $this->orderBy,$this->direction)
            ->get();

            foreach ($userCounts as  $item) {
                $this->editRow[$item->id] = false;
                $this->showInfo[$this->rowSelected] = false;
            }
        
            if($this->editRowVerify){
                if ( $this->rowSelected) {
                    $this->editRow[$this->rowSelected] = true;
    
                    if ( $this->showInfoTrue) {
                        $this->showInfo[$this->rowSelected] = true;
                    }
                }
            
            }
        
        $userCountsTotalDistinct = UserCount::distinct()->count('ip');
        $userCountsChile = UserCount::where('countryName','Chile')->distinct()->count('ip');

        $items= collect(['name','name2']);

        return view('livewire.admin.visits.lista',compact('userCounts','userCountsTotalDistinct','userCountsChile'));
    }


    public function editRowTrue($user_id){
        $this->editRow[$this->rowSelected] = false;
        $this->editRow[$user_id] = true;
        $this->rowSelected = $user_id;
        $this->editRowVerify = true;
        $this->showInfoTrue = false;
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
