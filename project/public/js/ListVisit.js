let tr_content_Select;
function gettreatmentslct(target){
	  $.ajax({
			//url: "{{route('make_htm_get_payment_method_slct_ajax')}}",
      //url: '{{route("customers.make_htm_get_treatment_slct")}}',
      //url: 'make_htm_get_treatment_slct_ajax',
      //url: window.treatmentSelectUrl,
      //url: 'make_htm_get_treatment_slct',make_htm_get_treatment_slct
      //url: 'customers/make_htm_get_payment_method_slct_ajax',
      //url: makePaymentMethodUrl,
      //url: '/customers/make_htm_get_payment_method_slct_ajax',
      //url: PAYMENT_METHOD_URL,
       //url: window.ROUTES.treatment, // ←ここ
       url: '/customers/make_htm_get_treatment_slct_ajax',
  type: 'POST',
			type: 'post', // getかpostを指定(デフォルトは前者)
			dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
			scriptCharset: 'utf-8',
			frequency: 10,
			cache: false,
			async : false,
			data: {'target': target},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		}).done(function (data) {
      //console.log("data="+data);
      document.getElementById("tr").innerHTML=data;
		}) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
			alert(XMLHttpRequest.status);
			alert(textStatus);
			alert(errorThrown);	
			alert('エラー');
		});
    
    tr_content_Select=new TomSelect('#tr_content_slct', {
      maxOptions: null,
				plugins: {
				remove_button: {
					title: '削除',   // マウスオーバー時のツールチップ
					// label: '×',  // ボタンに表示する文字（デフォルトは ×）
				}
				},
				create: false,
				sortField: { field: '$order' },
				placeholder: '施術を選択してください。'
    });
}

$(document).ready(function() {
    $('#tr_content_slct').select2({
        width: '300px',
        multiple: true
    });
 });

function ClearSerch(){
	document.getElementById("kensakukey_txt").value="";
}

function location_href(){
  window.location.reload(false);
  alert("更新しました。");
}

function delArert(targetUser){
	ary = targetUser.split(' ');
	let res=window.confirm( '登録番号: ' + ary[0]+'\n'+ ary[1]+' '+ary[2]+'さんのデータを削除します。よろしいですか？');
	if(res){
		return true;
	}else{
		return false;
	}
}

$(function(){
  $("#del_wire_btn").on('click', function() {
    $('#delConfirmModal').modal('hide');
  })
});

/*
$(function(){
  $("#del_btn").on('click', function() {
      console.log("del_btn");
      let Tvisit_history_serial=document.getElementById("visit_history_serial_d").innerText;
      console.log("Tvisit_history_serial="+Tvisit_history_serial);
      $.ajax({
        //url: "customers/del_visit_data_ajax",
        url: "{{ route('customers.del_visit_data_ajax.post') }}",
        type: 'post', // getかpostを指定(デフォルトは前者)
        dataType: 'text', 
        scriptCharset: 'utf-8',
        frequency: 10,
        cache: false,
        async : false,
        data: {"Tvisit_history_serial": Tvisit_history_serial},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (data) {
        location.replace(location.href);
        $msg= "削除しました。";
		  	alert($msg);
      }) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.status);
        alert(textStatus);
        alert(errorThrown);	
        alert('エラー');
      });
    $('#delConfirmModal').modal('hide');
  })
});
*/

$(function(){
  $('#delConfirmModal').on('show.bs.modal', function (event) {
    //モーダルを開いたボタンを取得
    let button = $(event.relatedTarget);
    //モーダルを取得
    let modal_delConfirm = $(this);
    let visit_history_serial=document.getElementById("visit_history_serial").innerText;

    const visit_num=Number(visit_history_serial.slice(-2));
    let name = button.data('name');
    let num = button.data('num');
    sejyutu_naiyou = button.data('sejyutu_naiyou');
    let sejyutusya= button.data('sejyutusya');
    let visit_date = button.data('visit_date');
    visit_history_serial = button.data('visit_history_serial');
    document.getElementById("delTargetVisitHistorySerial_hdn").value=visit_history_serial;
    modal_delConfirm.find('.modal-body span#visit_date_d').text(visit_date);
    modal_delConfirm.find('.modal-body span#tr_d').text(sejyutu_naiyou);
    //modal_delConfirm.find('.modal-body span#visit_date_d').text(visit_date);
    modal_delConfirm.find('.modal-body span#visit_history_serial_d').text(visit_history_serial.slice(-2));
    modal_delConfirm.find('.modal-body span#sejyutusya_d').text(sejyutusya);
    //modal_delConfirm.find('.modal-body span#name_d').text(name);
  });
});

$(function(){
  // モーダルの中の「ボタン1」を押した時の処理
    $("#btn1").on('click', function() {
      //const select = tr_content_Select;
      const treatment_value_array = tr_content_Select.getValue();
      //const value = select.getValue();
      console.log(treatment_value_array);
      let Tdate=document.getElementById("visit_date").value;
      let Tvisit_history_serial=document.getElementById("TargetVisitHistorySerial_hdn").value;
      //let Tvisit_history_serial=document.getElementById("visit_history_serial").innerText;
      //let Ttr_content=document.getElementById("tr_content_slct").value;
      //let Tpoint=document.getElementById("point").value;
      if(treatment_value_array.length === 0){
        alert("施術内容を選択してください。");
        return false;
      }
      $('#ModifyModal').modal('hide');
      $.ajax({
        url: "save_visit_data_ajax",
        //url: "{{ route('customers.save_visit_data_ajax.post') }}",
        //url: @json(route('customers.save_visit_data_ajax')),
        type: 'post', // getかpostを指定(デフォルトは前者)
        dataType: 'text', 
        scriptCharset: 'utf-8',
        frequency: 10,
        cache: false,
        async : false,
        //data: {"Tdate": Tdate,"Tvisit_history_serial": Tvisit_history_serial,"Ttr_content":Ttr_content,"Tpoint":Tpoint},
        data: {"Tdate": Tdate,"Tvisit_history_serial": Tvisit_history_serial,"treatment_value_array":treatment_value_array},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }).done(function (data) {
        location.replace(location.href);
        $msg= "修正しました。";
        //console.log("data 2 ="+data);
        if(data=="1"){
          $msg= "登録しました。";
        }
		  	alert($msg);
      }) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.status);
        alert(textStatus);
        alert(errorThrown);	
        alert('エラー');
      });
    });
});

$(function(){
  $('#ModifyModal').on('show.bs.modal', function (event) {
    let visit_history_serial,sejyutu_naiyou,visit_date,newSerial,name;
    //モーダルを開いたボタンを取得
    let button = $(event.relatedTarget);
    //モーダルを取得
    let modal_Yoyaku = $(this);
    name = button.data('name');
    let num = button.data('num');
    newSerial=button.data('nserial');
    //console.log("num="+num);
    //visit_history_serial = button.data('visit_history_serial');
    //if(typeof newSerial === 'undefined'){
    if(typeof num !== 'undefined'){
      visit_history_serial = button.data('visit_history_serial');
      //console.log("visit_history_serial="+visit_history_serial);
      const visit_num=Number(visit_history_serial.slice(-2));
      document.getElementById("TargetVisitHistorySerial_hdn").value=visit_history_serial;
      num = button.data('num');
      sejyutu_naiyou = button.data('sejyutu_naiyou');
      sejyutusya= button.data('sejyutusya');
      visit_date = button.data('visit_date');
      visit_history_serial = button.data('visit_history_serial');
      tr_html=gettreatmentslct(sejyutu_naiyou);
      //modal_Yoyaku.find('.modal-body span#num').text(cnt);
      modal_Yoyaku.find('.modal-body span#visit_history_serial').text(visit_history_serial.slice(-2));
      modal_Yoyaku.find('.modal-body span#sejyutusya').text(sejyutusya);
      modal_Yoyaku.find('.modal-body input#visit_date').val(visit_date);
      modal_Yoyaku.find('.modal-title').text("来店記録修正");
    }else{
      tr_html=gettreatmentslct('');
      //console.log("newSerial-3="+newSerial);
      newSerial_array=newSerial.split('-');
      //console.log("newSerial_array ="+newSerial_array[2]);
      modal_Yoyaku.find('.modal-body span#num').text(newSerial_array[2]);
      modal_Yoyaku.find('.modal-body span#visit_history_serial').text(newSerial.slice(-2));
      modal_Yoyaku.find('.modal-body input#visit_date').val("");
      modal_Yoyaku.find('.modal-title').text("新規来店記録登録");
      document.getElementById("TargetVisitHistorySerial_hdn").value=newSerial;
      //document.getElementById("TargetVisitHistorySerial_hdn").value=visit_history_serial;
      //document.getElementById('ModalLabel').innerText="新規来店記録登録";
    }
  });
});