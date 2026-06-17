<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contract;
use App\Models\PaymentHistory;
use App\Models\SalesRecord;
use App\Models\Good;
use App\Consts\initConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Log;
if(!isset($_SESSION)){session_start();}

class DailyReport extends Component
{
    public function sort($sort_key){
        $sort_key_array=array();
        $sort_key_array=explode("-", $sort_key);
        $this->sort_key_p=$sort_key_array[0];
        $this->asc_desc_p=$sort_key_array[1];
        session(['sort_key' =>$sort_key_array[0]]);
        session(['asc_desc' =>$sort_key_array[1]]);
    }
  
    public function render(){
        $header="";$slot="";
        $today = date("Y-m-d");
        $from_place="";
        OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        $target_historyBack_inf_array=initConsts::TargetPageInf($_SESSION['access_history'][0]);
        $backmonthly="";
        foreach($_SESSION['access_history'] as $targeturl){
            if(strpos($targeturl, 'ShowMonthlyReport') !== false){
                $backmonthly=true;
                break;
            }else if (strpos($targeturl, 'ShowMenuCustomerManagement') !== false){
                $backmonthly=false;
                break;
            }
        }
        if($backmonthly===true){
            if(isset($_POST['target_date_from_monthly_rep'])){
                $today=$_POST['target_date_from_monthly_rep'];
            }else{
                $today=$_SESSION['backmonthday'];
            }
            $from_place="monthly_rep";
        }else if(isset($_POST['target_date'])){
            $today=$_POST['target_date'];
        }else if(isset($_POST['target_date_from_monthly_rep'])){
            $today=$_POST['target_date_from_monthly_rep'];
            $from_place="monthly_rep";
        }

        $PaymentHistories=PaymentHistory::where('date_payment','=',$today)
            ->where('payment_histories.branch','=',session('target_branch_serial'))
            ->leftJoin('users', 'payment_histories.serial_user', '=', 'users.serial_user')
            ->paginate(initConsts::DdisplayLineNumCustomerList());
        //$subtotal_treatment=PaymentHistory::where('date_payment','=',$today)->sum('amount_payment');
        $subtotal_treatment=$PaymentHistories->where('date_payment','=',$today)->sum('amount_payment');
        $html_dayly_report_table=OtherFunc::make_html_dayly_report_table($today);
        $SalesRecords=SalesRecord::where('date_sale','=',$today)
            ->leftJoin('users', 'sales_records.serial_user', '=', 'users.serial_user')
            ->leftJoin('goods', 'sales_records.serial_good', '=', 'goods.serial_good')
            ->paginate(initConsts::DdisplayLineNumCustomerList());
        $subtotal_good=SalesRecord::where('date_sale','=',$today)->sum('selling_price');
        $total=$subtotal_treatment+$subtotal_good;
        /*
        $PaymentMethod=initConsts::PaymentMethod();
        $PaymentMethodArray=explode(",", $PaymentMethod);
		$Sum=array();
        $Sum['total']=0;
        foreach($PaymentMethodArray as $value){
			$PaymentMethod_inf_array=explode("_", $value);
			$PaymentMethod_hyouji_array[]=$PaymentMethod_inf_array[1];
			$PaymentMethod_key_array[]=$PaymentMethod_inf_array[0];
            $Sum[$PaymentMethod_inf_array[0]]=PaymentHistory::where('date_payment','=',$today)
                ->where('payment_histories.how_to_pay','=',$PaymentMethod_inf_array[0])
                ->where('payment_histories.branch','=',session('target_branch_serial'))
                ->sum('amount_payment');
            $Sum['total']=$Sum['total']+$Sum[$PaymentMethod_inf_array[0]];
		}

        */
        /*
        $Sum['cash']=PaymentHistory::where('date_payment','=',$today)
                ->where('payment_histories.how_to_pay','=','cash')
                ->where('payment_histories.branch','=',session('target_branch_serial'))
                ->sum('amount_payment');
        $Sum['card']=PaymentHistory::where('date_payment','=',$today)
                //->where('date_payment','=',$today)
            ->where('how_to_pay','=','card')
            ->where('payment_histories.branch','=',session('target_branch_serial'))
            ->sum('amount_payment');
        $Sum['paypay']=PaymentHistory::where('date_payment','=',$today)
            ->where('how_to_pay','=','paypay')
            ->where('payment_histories.branch','=',session('target_branch_serial'))
            ->sum('amount_payment');
        $Sum['smart']=PaymentHistory::where('date_payment','=',$today)
            ->where('how_to_pay','=','smart')
            ->where('payment_histories.branch','=',session('target_branch_serial'))
            ->sum('amount_payment');
        //$Sum['total_cash']=$Sum['cash'];
        */
        //$Sum['total']=$Sum['cash']+$Sum['card']+$Sum['paypay']+$Sum['smart'];
        session(['targetDay' => $today]);
        $_SESSION['backmonthday']=$today;
        //return view('livewire.daily-report',compact('target_historyBack_inf_array','PaymentHistories','SalesRecords','today','subtotal_treatment','subtotal_good','total','Sum','from_place'));
        return view('livewire.daily-report',compact('total','today','target_historyBack_inf_array','html_dayly_report_table','from_place'));
    }
}
