<?php

namespace App\Http\Livewire\Admin\Deliveries;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\DeliveryController;

class OrderInfo extends Component{

    use WithFileUploads;

    public $mostrar_venta=false;
    public $venta;

    public $payment_receipt;


    protected $listeners = ['mostrar_venta','render'];

    protected $rules=[
        'payment_receipt' => 'image',  
    ];

    public function render(){

        return view('livewire.admin.deliveries.order-info');
    }
    
    public function mostrar_venta($id){
        $this->mostrar_venta=true;
        $this->venta= Sale::find($id);

    }

    public function payOrder(Sale $sale, $account){
      $this->emit('payOrder',$sale,$account);
    }

    public function deliverOrder(Sale $sale,$reverse=false){
        $this->emit('deliverOrder',$sale,$reverse);
    }
    public function saveDriverComment(Sale $sale,$comment){
        $this->emit('saveDriverComment',$sale,$comment);
    }

    public function savePaymentReceipt(){
        $this->validate();

        if (!Storage::exists('payment_receipts')) {
            Storage::makeDirectory('payment_receipts');
        }

        $manager =  new ImageManager();
        $image1 = $manager->make( $this->payment_receipt );
        $image1->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image1->encode('webp');
        $url = 'payment_receipts/receipt_sale_' . $this->venta->id . '.webp';
        $image1->save('storage/'.$url);  

        // $url = $this->payment_receipt->store('payment_receipts');

        $this->venta->payment_receipt_url= $url;
        $this->venta->payment_receipt_date= Carbon::now();
        $this->venta->payment_receipt_by= auth()->user()->id;
        $this->venta->save();

        $this->reset('payment_receipt');
        $this->dispatchBrowserEvent('toast',['title'=>'Guardado con exito']);

    }
}
