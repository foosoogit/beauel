<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Staff;
use App\Consts\initConsts;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class StaffList extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="";
    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key_staff' =>$sort_key_array[0]]);
		session(['asc_desc_staff' =>$sort_key_array[1]]);
	}

    public function send_attendance_card($TargetStaffSerial){
        OtherFunc::send_attendance_card($TargetStaffSerial);
	}

    public function render()
    {
        if(!isset($sort_key_p) and session('sort_key_staff')==null){
			session(['sort_key_staff' =>'']);
		}
		$this->sort_key_p=session('sort_key_staff');

		if(!isset($asc_desc_p) and session('asc_desc_staff')==null){
			session(['asc_desc_staff' =>'ASC']);
		}
		$this->asc_desc_p=session('asc_desc_staff');

        $targetSortKey="";
		if(session('sort_key')<>""){
			$targetSortKey=session('sort_key');
		}else{
			$targetSortKey=$this->sort_key_p;
		}
        $staffQuery = Staff::query();
		if($this->sort_key_p<>''){
			if($this->asc_desc_p=="ASC"){
				$staffQuery =$staffQuery->orderBy($this->sort_key_p, 'asc');
			}else{
				$staffQuery =$staffQuery->orderBy($this->sort_key_p, 'desc');
			}
		}

        $targetPage="";
		//$staffs=Staff::paginate($perPage = initConsts::DdisplayLineNumCustomerList(),['*'], 'page',$targetPage);
        $staffs=$staffQuery->paginate($perPage = initConsts::DdisplayLineNumCustomerList(),['*'], 'page',$targetPage);
        return view('livewire.staff-list',compact('staffs'));
    }
}
