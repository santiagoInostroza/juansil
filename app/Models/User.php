<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use Billable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function customer(){
    //     $customer = Customer::where('user_id',$this->id)->get();
    //     if($customer->count()){
    //         return $customer;
    //     }
    //     return false;
    // }

    public function eventualCustomer(){
        $customer = Customer::where('user_id',null)->where(Customer::raw( 'lower(email) '),'=', Str::lower($this->email)  ) ->get();

        if($customer->count()){
            return $customer;
        }
        return false;
    }

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    // get sales
      public function sales(){
        $sales = Sale::where('user_created',$this->id)->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }

    // sales of the month 
    public function salesOfTheMonth($month = null, $year = null){
        if($month == null){
            $month = date('m');
        }
        if($year == null){
            $year = date('Y');
        }
        $monthAndYear=[
            'month' => $month,
            'year' => $year,
        ];
        $sales = Sale::where('user_created',$this->id)
        ->whereMonth('date',$month)
        ->whereYear('date',$year)
        ->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }



    // sales of the month where payment = 3 
    public function salesOfTheMonthCompleted($month = null, $year = null){

        if($month == null){
            $month = date('m');
        }
        if($year == null){
            $year = date('Y');
        }
        $monthAndYear=[
            'month' => $month,
            'year' => $year,
        ];

        
        $sales = Sale::where('user_created',$this->id)->where('payment_status',3)
            ->where(function($query) use($monthAndYear){
                $query->where(function($q) use($monthAndYear){
                    $q->where('payment_date', '!=' ,null)
                    ->whereMonth('payment_date', $monthAndYear['month'])
                    ->whereYear('payment_date', $monthAndYear['year'])
                    ->get();
                    })->orWhere(function($query) use($monthAndYear){
                        $query
                        ->where('payment_date' ,null)
                        ->whereMonth('date',$monthAndYear['month'])
                        ->whereYear('date',$monthAndYear['year'])
                        ->get();
                    });
            })->get();
                   

        if($sales->count()){
            return $sales;
        }
        return false;
    }


    // sales of the year where payment_status = 3 
    public function salesOfTheYear(){
        $sales = Sale::where('user_created',$this->id)->whereYear('payment_date',date('Y'))->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }
    // sales of the year where payment_status = 3 
    public function salesOfTheYearCompleted(){
        $sales = Sale::where('user_created',$this->id)->where('payment_status',3)->whereYear('payment_date',date('Y'))->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }

    // sales of the day 
    public function salesOfToday(){
        $sales = Sale::where('user_created',$this->id)->whereDate('date',date('Y-m-d'))->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }

    //sales of yesterday 
    public function salesOfYesterday(){
        $sales = Sale::where('user_created',$this->id)->whereDate('created_at',date('Y-m-d',strtotime('-1 day')))->get();
        if($sales->count()){
            return $sales;
        }
        return false;
    }






    


    public function createdBy(){
        $user = User::find($this->user_created); 
        return $user;
    }


}
