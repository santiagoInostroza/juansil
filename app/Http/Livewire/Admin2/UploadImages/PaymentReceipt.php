<?php

namespace App\Http\Livewire\Admin2\UploadImages;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class PaymentReceipt extends Component{
    use WithFileUploads;
    
    public $sale;
    public $payment_receipt;
    public $size;

    protected $rules=[
        'payment_receipt' => 'required|image|max:2048',
    ];
    protected $messages=[
        'payment_receipt.required' => 'Debe seleccionar una imagen',
        'payment_receipt.image' => 'El archivo debe ser una imagen',
        'payment_receipt.max' => 'El tamaño máximo de la imagen es de 2MB',
    ];

    public function mount($sale){
        $this->sale=$sale;
        $this->payment_receipt=$sale->payment_receipt;
        $this->size=(Str::length($this->size)>0) ? $this->size:'';
    }

    public function render(){
        return view('livewire.admin2.upload-images.payment-receipt');
    }

    public function savePaymentReceipt(){
        $this->validate();

        if (!Storage::exists('payment_receipts')) {
            Storage::makeDirectory('payment_receipts');
        }

        if(Storage::exists($this->sale->payment_receipt_url)){
            Storage::delete($this->sale->payment_receipt_url);
        }

        $manager =  new ImageManager();
        $image1 = $manager->make( $this->payment_receipt );
        $image1->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image1->encode('webp');
        $url = 'payment_receipts/receipt_sale_' .rand().'_'. $this->sale->id . '.webp';
        $image1->save('storage/'.$url);  

        // $url = $this->payment_receipt->store('payment_receipts');

        $this->sale->payment_receipt_url= $url;
        $this->sale->payment_receipt_date= Carbon::now();
        $this->sale->payment_receipt_by= auth()->user()->id;
        $this->sale->verify_payment_receipt= 0;
        $this->sale->verify_payment_receipt_by= 0;
        $this->sale->save();

  
        $this->reset('payment_receipt');
        $this->emitUp('render');
        $this->dispatchBrowserEvent('toast',['title'=>'Guardado con exito']);

    }
}
