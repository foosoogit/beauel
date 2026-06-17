<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Consts\initConsts;
use Livewire\WithPagination;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Log;
use App\Models\CashBooksSmall;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
if(!isset($_SESSION)){session_start();}

class CashBookSmallLw extends Component
{
    use WithPagination;
    public $test,$kensakukey,$target_date,$payment,$deposit,$summary,$amount,$remarks,$id_txt,$serch_key_month,$serch_key_date,$serch_key_all,$serch_key_payment,$serch_key_deposit,$sort_key_p,$asc_desc_p;
    
    public function del_cash_book_rec($target_sirial){
		/*
        CashBook::where('id',$target_Vsirial)
			->update(['visit_history_serial' => "del_".$target_Vsirial]);
        */
		CashBooksSmall::where('id',$target_sirial)->delete();
	}

    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key_CashBooksSmall' =>$sort_key_array[0]]);
		session(['asc_desc_CashBooksSmall' =>$sort_key_array[1]]);
	}

    public function search_all(){
        $this->serch_key_date="";
        $this->serch_key_month="";
    }

    public function searchClear(){
		session(['sort_key_CashBooksSmall' =>'target_date']);
        session(['asc_desc_CashBooksSmall' =>'desc']);
        $this->serch_key_month="";
		$this->serch_key_all="";
		$this->serch_key_date="";
        session(['serch_payment_flg'=>'checked'],['serch_deposit_flg'=>'checked'],['serchKey'=>''],['serch_payment_flg'=>'target_date'],['asc_desc_CashBooksSmall' =>'Desc'],['sort_key_CashBooksSmall' =>'']);
	}

    public function serch_payment(){
        if(session('serch_payment_flg')=="checked"){
            session(['serch_payment_flg' => ""]);
        }else{
            session(['serch_payment_flg' => "checked"]);
        }
    }
    
    public function serch_deposit(){
        if(session('serch_deposit_flg')=="checked"){
            session(['serch_deposit_flg' => ""]);
        }else{
            session(['serch_deposit_flg' => "checked"]);
        }
    }

    public function search_month(){
        $this->serch_key_date="";
        $this->serch_key_all="";
    }

    public function search_date(){
        $this->serch_key_month="";
        $this->serch_key_all="";
    }

    public function del($id){
        $CashBooksSmall = CashBooksSmall::find($id);
        $CashBooksSmall->delete();
    }
    public function submitForm(Request $request){
        $validator = Validator::make($request->all(), [
            'components.0.updates.target_date' => 'required',
            'components.0.updates.payment_deposit_rdo' => 'required',
            'components.0.updates.summary' => 'required',
            'components.0.updates.amount'=> 'required',
        ]);
        if ($validator->fails()) {
           $this->skipRender();
        }
    }

    public function render(Request $request)
    {
        OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        $balance=CashBooksSmall::select(DB::raw('SUM(deposit -  payment) as balance'))
            ->value('balance');
        $CashBooksSmallQuery=CashBooksSmall::query();
        $balance_Query=CashBooksSmall::query();
        $CashBooksSmallQuery=$CashBooksSmallQuery->where('branch',session('target_branch_serial'));
        $balance_Query=$balance_Query->where('branch',session('target_branch_serial'));
        if($this->serch_key_month<>""){
            $key="%".$this->serch_key_month."%";
            $CashBooksSmallQuery=$CashBooksSmallQuery->where('target_date','like',$key);
            $balance_Query=$balance_Query->where('target_date','like',$key);
        }else if($this->serch_key_date<>""){
            $key="%".$this->serch_key_date."%";
            $CashBooksSmallQuery=$CashBooksSmallQuery->where('target_date','like',$key);
            $balance_Query=$balance_Query->where('target_date','like',$key);
        }else if($this->serch_key_all<>""){
            $key="%".$this->serch_key_all."%";
            $CashBooksSmallQuery=$CashBooksSmallQuery
				->where('target_date','like',$key)
				->orwhere('summary','like',$key)
				->orwhere('payment','like',$key)
				->orwhere('deposit','like',$key)
				->orwhere('remarks','like',$key);
            $balance_Query=$balance_Query
                ->where('target_date','like',$key)
				->orwhere('summary','like',$key)
				->orwhere('payment','like',$key)
				->orwhere('deposit','like',$key)
				->orwhere('remarks','like',$key);
        }

        if(session('serch_payment_flg')=="checked" &&  empty(session('serch_deposit_flg'))){
            $CashBooksSmallQuery=$CashBooksSmallQuery->where('in_out','=','payment');
            $balance_Query=$balance_Query->where('in_out','=','payment');
        }else if(empty(session('serch_payment_flg')) && session('serch_deposit_flg')=="checked"){
            $CashBooksSmallQuery=$CashBooksSmallQuery->where('in_out','=','deposit');
            $balance_Query=$balance_Query->where('in_out','=','deposit');
        }
        //Log::info($_SESSION['access_history']);
        $target_historyBack_inf_array=initConsts::TargetPageInf($_SESSION['access_history'][0]);
        $newCashBooksSmallQuerySerial="";
        $CashBooksSmallQuery =$CashBooksSmallQuery->orderBy('target_date', 'desc')->orderBy('created_at', 'desc');
        $CashBooksSmallQuery=$CashBooksSmallQuery->paginate($perPage = initConsts::DdisplayLineNumCustomerList(),['*']);
        $balance_res=$balance_Query->get();

        $serch_payment_sum=$balance_res->sum('IntPayment');
        $serch_deposit_sum=$balance_res->sum('IntDeposit');
        $serch_balance=$serch_deposit_sum-$serch_payment_sum;
        return view('livewire.cash-book-small-lw',compact('serch_balance','serch_deposit_sum','serch_payment_sum','balance','target_historyBack_inf_array','CashBooksSmallQuery','newCashBooksSmallQuerySerial'));
    }
}
