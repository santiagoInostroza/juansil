<?php

namespace App\Http\Livewire\Admin\PagosPendientes;

use Carbon\Carbon;
use App\Models\Pay;
use App\Models\Sale;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerPending extends Component{
    public $customer_id;
    public $customer;
    public $monto;

    protected $rules=['monto' => 'required'];
    protected $messages=['monto.required' => 'Debes ingresar el monto a pagar'];
    

    public function render(){
        $pays = Pay::all();
        return view('livewire.admin.pagos-pendientes.customer-pending',compact('pays'));
    }

    public function mount(){
        if ($this->customer_id > 0) {
           $this->customer = Customer::find($this->customer_id);
        }
    }

    public function pagarMonto(){

        $this->validate();

        $pay = new Pay();
        $pay->total = $this->monto;
        $pay->fecha = Carbon::now();
        $pay->user_created = Auth::user()->id;
        $pay->save();
        

        foreach ($this->customer->pending() as $pending) {
            $venta = Sale::find($pending->id);
            $monto_pendiente = $pending->pending_amount;

            if ($this->monto >= $monto_pendiente) {//paga total de la veta
                $venta->payment_amount = $venta->total;
                $venta->payment_status = 3;
                $venta->pending_amount = 0;
                $venta->payment_date = Carbon::now();
                $venta->user_modified = Auth::user()->id;
                $venta->save();
                $pay->sales()->attach([$venta->id]);

                $this->monto -= $monto_pendiente;
                
            }else if($this->monto < $monto_pendiente && $this->monto > 0){//PAGO PARCIAL
                
                $venta->payment_amount += $this->monto;
                $venta->payment_status = 2;
                $venta->pending_amount -= $this->monto;
                $venta->payment_date = Carbon::now();
                $venta->user_modified = Auth::user()->id;
                $venta->save();
                $pay->sales()->attach([$venta->id]);
            }else{
                break;
            }
           
        }

      

     
    }
    
}
