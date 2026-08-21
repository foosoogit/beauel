@extends('layouts.appCustomer')
@section('content')
<script type="text/javascript" src="{{ asset('/js/PaymentRegistration.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/MediaRecord.js?2023013029') }}"></script>
<style type="text/css">
input{border: 1px solid #aaa;}
table td {border: 1px solid #aaa;}
</style>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<!--<div class="card">-->
				<div class="row">
                    @include('layouts.header')
                </div>
				<table cellpadding="5">
					<tr>
						<td rowspan="2"><a href="/customers/ShowSyuseiContract/{{$targetContract->serial_keiyaku}}/{{$targetContract->serial_user}}" class="btn btn-primary btn-sm ml-xl-2">契約書</a></td>
						<td>氏名</td>
						<td>契約日</td>
						<td>契約内容</td>
						<td>契約期間</td>
						<td>契約金額</td>
						<td>契約番号</td>
					</tr>
					<tr>
						<td>{{ optional($targetUser)->name_sei }}&nbsp;{{ optional($targetUser)->name_mei }}</td>
						<td>{{$targetContract->keiyaku_bi}}</td>
						<td>{{$KeiyakuNaiyou}}</td>
						<td>{{$targetContract->keiyaku_kikan_start}}～{{$targetContract->keiyaku_kikan_end}}</td>
						<td>{{number_format($targetContract->keiyaku_kingaku)}}円</td>
						<td>{{$targetContract->serial_keiyaku}}</td>
					</tr>
				</table>
				<p style="line-height:2rem"></p>
				<form action="{{ route('customers.recordVisitPaymentHistory') }}" method="POST">@csrf
					
					{!! $html_payment_record_table !!}
				<br>
				<table style="width: 100%">
					<tr>
						<td colspan="8">施術記録@if ($targetContract->keiyaku_type<>'subscription')(契約施術回数：{{$sejyutukaisu->treatments_num}}回)@endif<input name="ContractSerial" type="hidden" value="{{ session('ContractSerial') }}"/></td>
					</tr>
					<tr>
						<td {!!$set_gray_array[0]!!} style="height: 22px">
							1回<button name="count_btn" type="submit" value="01" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[0]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[1]!!} style="height: 22px">
							2回<button name="count_btn" type="submit" value="02" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[1]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[2]!!} style="height: 22px">
							3回<button name="count_btn" type="submit" value="03" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[2]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[3]!!} style="height: 22px">
							4回<button name="count_btn" type="submit" value="04" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[3]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[4]!!} style="height: 22px">
							5回<button name="count_btn" type="submit" value="05" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[4]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[5]!!} style="height: 22px">
							6回<button name="count_btn" type="submit" value="06" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[5]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[6]!!} style="height: 22px">
							7回<button name="count_btn" type="submit" value="07" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[6]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[7]!!} style="height: 22px">
							8回<button name="count_btn" type="submit" value="08" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[7]}}>カルテ</button>
						</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[0]!!}>
						<input name="visitDate[]" id="visitDateId[0]" type="date" value="{{optional($VisitDateArray)[0]}}" {!!$set_gray_array[0]!!} {{$visit_disabeled[0]}}/>{{--&nbsp;Point<input name="point[]" id="point[0]" type="text" size="3" value="{{optional($PointArray)[0]}}" {!!$set_gray_array[0]!!} {{$visit_disabeled[0]}}/>--}}</td>
						<td {!!$set_gray_array[1]!!}>
						<input name="visitDate[]" id="visitDateId[1]" type="date" value="{{optional($VisitDateArray)[1]}}" {!!$set_gray_array[1]!!} {{$visit_disabeled[1]}}/>{{--&nbsp;Point<input name="point[]" id="point[1]" type="text" size="3" value="{{optional($PointArray)[1]}}" {!!$set_gray_array[1]!!} {{$visit_disabeled[1]}}/>--}}</td>
						<td {!!$set_gray_array[2]!!}>
						<input name="visitDate[]" id="visitDateId[2]" type="date" value="{{optional($VisitDateArray)[2]}}" {!!$set_gray_array[2]!!} {{$visit_disabeled[2]}}/>{{--&nbsp;Point<input name="point[]" id="point[2]" type="text" size="3" value="{{optional($PointArray)[2]}}" {!!$set_gray_array[2]!!} {{$visit_disabeled[2]}}/>--}}</td>
						<td {!!$set_gray_array[3]!!}>
						<input name="visitDate[]" id="visitDateId[3]" type="date" value="{{optional($VisitDateArray)[3]}}" {!!$set_gray_array[3]!!} {{$visit_disabeled[3]}}/>{{--&nbsp;Point<input name="point[]" id="point[3]" type="text" size="3" value="{{optional($PointArray)[3]}}" {!!$set_gray_array[3]!!} {{$visit_disabeled[3]}}/>--}}</td>
						<td {!!$set_gray_array[4]!!}>
						<input name="visitDate[]" id="visitDateId[4]" type="date" value="{{optional($VisitDateArray)[4]}}" {!!$set_gray_array[4]!!} {{$visit_disabeled[4]}}/>{{--&nbsp;Point<input name="point[]" id="point[4]" type="text" size="3" value="{{optional($PointArray)[4]}}" {!!$set_gray_array[4]!!} {{$visit_disabeled[4]}}/>--}}</td>
						<td {!!$set_gray_array[5]!!}>
						<input name="visitDate[]" id="visitDateId[5]" type="date" value="{{optional($VisitDateArray)[5]}}" {!!$set_gray_array[5]!!} {{$visit_disabeled[5]}}/>{{--&nbsp;Point<input name="point[]" id="point[5]" type="text" size="3" value="{{optional($PointArray)[5]}}" {!!$set_gray_array[5]!!} {{$visit_disabeled[5]}}/>--}}</td>
						<td {!!$set_gray_array[6]!!}>
						<input name="visitDate[]" id="visitDateId[6]" type="date" value="{{optional($VisitDateArray)[6]}}" {!!$set_gray_array[6]!!} {{$visit_disabeled[6]}}/>{{--&nbsp;Point<input name="point[]" id="point[6]" type="text" size="3" value="{{optional($PointArray)[6]}}" {!!$set_gray_array[6]!!} {{$visit_disabeled[6]}}/>--}}</td>
						<td {!!$set_gray_array[7]!!}>
						<input name="visitDate[]" id="visitDateId[7]" type="date" value="{{optional($VisitDateArray)[7]}}" {!!$set_gray_array[7]!!} {{$visit_disabeled[7]}}/>{{--&nbsp;Point<input name="point[]" id="point[7]" type="text" size="3" value="{{optional($PointArray)[7]}}" {!!$set_gray_array[7]!!} {{$visit_disabeled[7]}}/>--}}</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[0]!!}>
						<select name="TreatmentDetailsSelect[0][]" style="width:200px; background-color:{{$only_treatment_color_array[0]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[0]!!}</select><br>
						</td>
						<td {!!$set_gray_array[1]!!}>
						<select name="TreatmentDetailsSelect[1][]" style="width:200px;background-color:{{$only_treatment_color_array[1]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[1]!!}</select>
						</td>
						<td {!!$set_gray_array[2]!!}>
						<select name="TreatmentDetailsSelect[2][]" style="width:200px;background-color:{{$only_treatment_color_array[2]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[2]!!}</select>
						</td>
						<td {!!$set_gray_array[3]!!}>
						<select name="TreatmentDetailsSelect[3][]" style="width:200px;background-color:{{$only_treatment_color_array[3]}};"class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[3]!!}</select>
						</td>
						<td {!!$set_gray_array[4]!!}>
						<select name="TreatmentDetailsSelect[4][]" style="width:200px;background-color:{{$only_treatment_color_array[4]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[4]!!}</select>
						</td>
						<td {!!$set_gray_array[5]!!}>
						<select name="TreatmentDetailsSelect[5][]" style="width:200px;background-color:{{$only_treatment_color_array[5]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[5]!!}</select>
						</td>
						<td {!!$set_gray_array[6]!!}>
						<select name="TreatmentDetailsSelect[6][]" style="width:200px;background-color:{{$only_treatment_color_array[6]}};"class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[6]!!}</select>
						</td>
						<td {!!$set_gray_array[7]!!}>
						<select name="TreatmentDetailsSelect[7][]" style="width:200px;background-color:{{$only_treatment_color_array[7]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[7]!!}</select>
						</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[10]!!} colspan="8">&nbsp;</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[8]!!} style="height: 22px">
							9回<button name="count_btn" type="submit" value="09" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[8]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[9]!!} style="height: 22px">
							10回<button name="count_btn" type="submit" value="10" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[9]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[10]!!}>
							11回<button name="count_btn" type="submit" value="11" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[10]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[11]!!}>
							12回<button name="count_btn" type="submit" value="12" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[11]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[12]!!}>
							13回<button name="count_btn" type="submit" value="13" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[12]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[13]!!}>
							14回<button name="count_btn" type="submit" value="14" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[13]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[14]!!}>
							15回<button name="count_btn" type="submit" value="15" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[14]}}>カルテ</button>
						</td>
						<td {!!$set_gray_array[15]!!}>
							16回<button name="count_btn" type="submit" value="16" formaction="{{ route('customers.ShowMedicalRecord.post') }}" formtarget="_blank" class="btn btn-outline-primary btn-sm" {{$visit_disabeled[15]}}>カルテ</button>
						</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[8]!!}>
						<input name="visitDate[]" id="visitDateId[8]" type="date" value="{{optional($VisitDateArray)[8]}}" {!!$set_gray_array[8]!!} {{$visit_disabeled[8]}}/>{{--&nbsp;Point<input name="point[]" id="point[8]" type="text" size="3" value="{{optional($PointArray)[8]}}" {!!$set_gray_array[8]!!} {{$visit_disabeled[8]}}/>--}}</td>
						<td {!!$set_gray_array[9]!!}>
						<input name="visitDate[]" id="visitDateId[9]" type="date" value="{{optional($VisitDateArray)[9]}}" {!!$set_gray_array[9]!!} {{$visit_disabeled[9]}}/>{{--&nbsp;Point<input name="point[]" id="point[9]" type="text" size="3" value="{{optional($PointArray)[9]}}" {!!$set_gray_array[9]!!} {{$visit_disabeled[9]}}/>--}}</td>
						<td {!!$set_gray_array[10]!!}>
						<input name="visitDate[]" id="visitDateId[10]" type="date" value="{{optional($VisitDateArray)[10]}}" {!!$set_gray_array[10]!!} {{$visit_disabeled[10]}}/>{{--&nbsp;Point<input name="point[]" id="point[10]" type="text" size="3" value="{{optional($PointArray)[10]}}" {!!$set_gray_array[10]!!} {{$visit_disabeled[10]}}/>--}}</td>
						<td {!!$set_gray_array[11]!!}>
						<input name="visitDate[]" id="visitDateId[11]" type="date" value="{{optional($VisitDateArray)[11]}}" {!!$set_gray_array[11]!!} {{$visit_disabeled[11]}}/>{{--&nbsp;Point<input name="point[]" id="point[11]" type="text" size="3" value="{{optional($PointArray)[11]}}" {!!$set_gray_array[11]!!} {{$visit_disabeled[11]}}/>--}}</td>
						<td {!!$set_gray_array[12]!!}>
						<input name="visitDate[]" id="visitDateId[12]" type="date" value="{{optional($VisitDateArray)[12]}}" {!!$set_gray_array[12]!!} {{$visit_disabeled[12]}}/>{{--&nbsp;Point<input name="point[]" id="point[12]" type="text" size="3" value="{{optional($PointArray)[12]}}" {!!$set_gray_array[12]!!} {{$visit_disabeled[12]}}/>--}}</td>
						<td {!!$set_gray_array[13]!!}>
						<input name="visitDate[]" id="visitDateId[13]" type="date" value="{{optional($VisitDateArray)[13]}}" {!!$set_gray_array[13]!!} {{$visit_disabeled[13]}}/>{{--&nbsp;Point<input name="point[]" id="point[13]" type="text" size="3" value="{{optional($PointArray)[13]}}" {!!$set_gray_array[13]!!} {{$visit_disabeled[13]}}/>--}}</td>
						<td {!!$set_gray_array[14]!!}>
						<input name="visitDate[]" id="visitDateId[14]" type="date" value="{{optional($VisitDateArray)[14]}}" {!!$set_gray_array[14]!!} {{$visit_disabeled[14]}}/>{{--&nbsp;Point<input name="point[]" id="point[14]" type="text" size="3" value="{{optional($PointArray)[14]}}" {!!$set_gray_array[14]!!} {{$visit_disabeled[14]}}/>--}}</td>
						<td {!!$set_gray_array[15]!!}>
						<input name="visitDate[]" id="visitDateId[15]" type="date" value="{{optional($VisitDateArray)[15]}}" {!!$set_gray_array[15]!!} {{$visit_disabeled[15]}}/>{{--&nbsp;Point<input name="point[]" id="point[15]" type="text" size="3" value="{{optional($PointArray)[15]}}" {!!$set_gray_array[15]!!} {{$visit_disabeled[15]}}/>--}}</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[8]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[8]}};"class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[8]!!}</select>
						</td>
						<td {!!$set_gray_array[9]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[9]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[9]!!}</select>
						</td>
						<td {!!$set_gray_array[10]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[10]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[10]!!}</select>
						</td>
						<td {!!$set_gray_array[11]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[11]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[11]!!}</select>
						</td>
						<td {!!$set_gray_array[12]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[12]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[12]!!}</select>
						</td>
						<td {!!$set_gray_array[13]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[13]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[13]!!}</select>
						</td>
						<td {!!$set_gray_array[14]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[14]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[14]!!}</select>
						</td>
						<td {!!$set_gray_array[15]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[15]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[15]!!}</select>
						</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[10]!!} colspan="8">&nbsp;</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[16]!!}>17回</td>
						<td {!!$set_gray_array[17]!!}>18回</td>
						<td {!!$set_gray_array[18]!!}>19回</td>
						<td {!!$set_gray_array[19]!!}>20回</td>
						<td {!!$set_gray_array[20]!!}>21回</td>
						<td {!!$set_gray_array[21]!!}>22回</td>
						<td {!!$set_gray_array[22]!!}>23回</td>
						<td {!!$set_gray_array[23]!!}>24回</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[16]!!}>
						<input name="visitDate[]" id="visitDateId[16]" type="date" value="{{optional($VisitDateArray)[16]}}"  {!!$set_gray_array[16]!!} {{$visit_disabeled[16]}}/>{{--&nbsp;Point<input name="point[]" id="point[16]" type="text" size="3" value="{{optional($PointArray)[16]}}" {!!$set_gray_array[16]!!} {{$visit_disabeled[16]}}/>--}}</td>
						<td {!!$set_gray_array[17]!!}>
						<input name="visitDate[]" id="visitDateId[17]" type="date" value="{{optional($VisitDateArray)[17]}}"  {!!$set_gray_array[17]!!} {{$visit_disabeled[17]}}/>{{--&nbsp;Point<input name="point[]" id="point[17]" type="text" size="3" value="{{optional($PointArray)[17]}}" {!!$set_gray_array[17]!!} {{$visit_disabeled[17]}}/>--}}</td>
						<td {!!$set_gray_array[18]!!}>
						<input name="visitDate[]" id="visitDateId[18]" type="date" value="{{optional($VisitDateArray)[18]}}"  {!!$set_gray_array[18]!!} {{$visit_disabeled[18]}}/>{{--&nbsp;Point<input name="point[]" id="point[18]" type="text" size="3" value="{{optional($PointArray)[18]}}" {!!$set_gray_array[18]!!} {{$visit_disabeled[18]}}/>--}}</td>
						<td {!!$set_gray_array[19]!!}>
						<input name="visitDate[]" id="visitDateId[19]" type="date" value="{{optional($VisitDateArray)[19]}}"  {!!$set_gray_array[19]!!} {{$visit_disabeled[19]}}/>{{--&nbsp;Point<input name="point[]" id="point[19]" type="text" size="3" value="{{optional($PointArray)[19]}}" {!!$set_gray_array[19]!!} {{$visit_disabeled[19]}}/>--}}</td>
						<td {!!$set_gray_array[20]!!}>
						<input name="visitDate[]" id="visitDateId[20]" type="date" value="{{optional($VisitDateArray)[20]}}" {!!$set_gray_array[20]!!} {{$visit_disabeled[20]}}/>{{--&nbsp;Point<input name="point[]" id="point[20]" type="text" size="3" value="{{optional($PointArray)[20]}}" {!!$set_gray_array[20]!!} {{$visit_disabeled[20]}}/>--}}</td>
						<td {!!$set_gray_array[21]!!}>
						<input name="visitDate[]" id="visitDateId[21]" type="date" value="{{optional($VisitDateArray)[21]}}" {!!$set_gray_array[21]!!} {{$visit_disabeled[21]}}/>{{--&nbsp;Point<input name="point[]" id="point[21]" type="text" size="3" value="{{optional($PointArray)[21]}}" {!!$set_gray_array[21]!!} {{$visit_disabeled[21]}}/>--}}</td>
						<td {!!$set_gray_array[22]!!}>
						<input name="visitDate[]" id="visitDateId[22]" type="date" value="{{optional($VisitDateArray)[22]}}" {!!$set_gray_array[22]!!} {{$visit_disabeled[22]}}/>{{--&nbsp;Point<input name="point[]" id="point[22]" type="text" size="3" value="{{optional($PointArray)[22]}}" {!!$set_gray_array[22]!!} {{$visit_disabeled[22]}}/>--}}</td>
						<td {!!$set_gray_array[23]!!}>
						<input name="visitDate[]" id="visitDateId[23]" type="date" value="{{optional($VisitDateArray)[23]}}" {!!$set_gray_array[23]!!} {{$visit_disabeled[23]}}/>{{--&nbsp;Point<input name="point[]" id="point[23]" type="text" size="3" value="{{optional($PointArray)[23]}}" {!!$set_gray_array[23]!!} {{$visit_disabeled[23]}}/>--}}</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[16]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[16]}};"class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[16]!!}</select>
						</td>
						<td {!!$set_gray_array[17]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[17]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[17]!!}</select>
						</td>
						<td {!!$set_gray_array[18]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[18]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[18]!!}</select>
						</td>
						<td {!!$set_gray_array[19]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[19]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[19]!!}</select>
						</td>
						<td {!!$set_gray_array[20]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[20]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[20]!!}</select>
						</td>
						<td {!!$set_gray_array[21]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[21]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[21]!!}</select>
						</td>
						<td {!!$set_gray_array[22]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[22]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[22]!!}</select>
						</td>
						<td {!!$set_gray_array[23]!!}>
						<select name="TreatmentDetailsSelect[]" style="width:200px;background-color:{{$only_treatment_color_array[23]}};" class="tom_select" multiple>{!!$TreatmentDetailsSelectArray[23]!!}</select>
						</td>
					</tr>
					<tr>
						<td {!!$set_gray_array[20]!!} colspan="8" style="height: 9px"></td>
					</tr>
					<tr>
						<td>メモ</td>
						<td colspan="7">
						<textarea cols="20" name="TextArea1" rows="2" disabled="disabled"></textarea></td>
					</tr>
				</table>
				<script>
					@if ($errors->any())
						alert("{{ implode('\n', $errors->all()) }}");
					@elseif (session()->has('success'))
						alert("{{ session()->get('success') }}");
					@endif
				</script>
				@if(optional($targetContract)->cancel===null)
					<p style="text-align: center"><button class="btn btn-primary w-100 my-3" type="submit" name="KeiyakuSerialBtn" id="KeiyakuSerialBtn" onclick="return payment_manage();">　　登　録　　</button></p>
				@else
					<p style="text-align: center"><button class="btn btn-primary w-100 my-3" type="submit" name="KeiyakuSerialBtn" id="KeiyakuSerialBtn" onclick="return canceled_message();" style="background-color:gray">　　登　録　　</button></p>
				@endif
				</form>
                <p>郵便番号：{{ $targetUser->postal }}</p>
                <p>住所：{{ $targetUser->address }}</p>
                <p>メール：{{ $targetUser->email }}</p>
                <p>生年月日：{{ $targetUser->birthdate }}</p>
                <p>電話番号：{{$targetUser->phone }}</p>
            </div>
        </div>
    </div>

@endsection