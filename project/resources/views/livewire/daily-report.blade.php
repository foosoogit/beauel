<div class="container text-center">
    <script src="{{asset('/js/DailyReport.js')}}" defer></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-4 justify-content-center align-middle">
                <div class="row">
                    @include('layouts.header')
                </div>
                <div class="mb-2 bg-success text-white"><span class="border border-success bg-success text-white rounded h5">&nbsp;{{session('target_branch_name')}}&nbsp;</span>&nbsp;&nbsp;日報</div>
                @if(session('target_branch_name')=="")
					<p class="display-1 text-danger">店舗が選択されていません。</p>
				@endif
                <div class="card-header">
                    <div class="row h3">
                        <div class="col-auto">
                            <form action="{{route('admin.DailyReport.post')}}" method="POST" name="getTargetDate_fm" id="getTargetDate_fm">@csrf<input name="target_date" id="target_date" type="date" onchange="getTargetdata(this);" value="{{$today}}"/></form></h3>
                        </div>
                        <div class="col-auto">
                            合計：{{number_format((int)$total)}}円
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        {!!$html_dayly_report_table!!}
                        {{--  
                        <table class="table-auto" border-solid>
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">顧客No.
                                    </th>
                                    <th class="border px-4 py-2 col-2">氏名
                                    </th>
                                    <th class="border px-4 py-2">施術内容
                                    </th>
                                    <th class="border px-4 py-2">ｸﾚｼﾞｯﾄ・ﾛｰﾝ<br>契約数・金額(税込）
                                    </th>
                                    <th class="border px-4 py-2">PayPay</th>
                                     <th class="border px-4 py-2">スマート支払い</th>

                                    <th class="border px-4 py-2">現金売上(現金分割・一括支払い)(税込）

                                    </th>

                                    <th class="border px-4 py-2">施術合計<br>金額(税込）

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PaymentHistories as $PaymentHistory)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $PaymentHistory->serial_user}}<br></td>
                                        <td class="border px-4 py-2">
                                            @if($PaymentHistory->ContractType=='subscription')
                                                <form action="/customers/ShowPaymentRegistrationIflame/{{$PaymentHistory->serial_keiyaku}}/{{$PaymentHistory->serial_user}}" method="GET">@csrf
                                                    <button type="submit" name="btn_serial" value="{{$PaymentHistory->serial_user}}">{{ $PaymentHistory->name_sei}}&nbsp;{{ $PaymentHistory->name_mei}}</button>
                                                </form>    
                                            @else
                                                <form method="GET" action="{{ route('customers.ShowInpRecordVisitPayment.get',['SerialKeiyaku' => $PaymentHistory->serial_keiyaku,'SerialUser'=>$PaymentHistory->serial_user])}}">@csrf
                                                    <button type="submit" name="btn_serial" value="{{$PaymentHistory->serial_user}}">{{ $PaymentHistory->name_sei}}&nbsp;{{ $PaymentHistory->name_mei}}</button>
                                                    <input name="target_day" type="hidden" value="{{$today}}"/>
                                                </form>    
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">&nbsp;</td>
                                        <td class="border px-4 py-2" style="text-align: right;">
                                            @if($PaymentHistory->Card_Amount!=="")
                                                {{ number_format($PaymentHistory->Card_Amount)}}
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2" style="text-align: right;">
                                            @if($PaymentHistory->PayPay_Amount!=="")
                                                {{ number_format($PaymentHistory->PayPay_Amount)}}
                                            @endif
                                        </td>
                                        
                                        <td class="border px-4 py-2" style="text-align: right;">
                                            @if($PaymentHistory->Smart_Amount!=="")
                                                {{ number_format($PaymentHistory->Smart_Amount)}}
                                            @endif
                                        </td>
                                        
                                    
                                        <td class="border px-4 py-2" style="text-align: right;">
                                            @if($PaymentHistory->Cash_Amount!=="")
                                                {{number_format($PaymentHistory->Cash_Amount)}}
                                            @endif
                                        </td>

                                        <td class="border px-4 py-2" style="text-align: right;">
                                            @if($PaymentHistory->amount_payment!=="")
                                                {{number_format($PaymentHistory->amount_payment)}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="border px-4 py-2" colspan="3" style="text-align: right;">合計</td>
                                    <td class="border px-4 py-2" style="text-align: right;">
                                        @if($Sum['card']!=="")
                                            {{ number_format($Sum['card'])}}
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2" style="text-align: right;">
                                        @if($Sum['paypay']!=="")
                                            {{ number_format($Sum['paypay'])}}
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2" style="text-align: right;">
                                        @if($Sum['smart']!=="")
                                            {{ number_format($Sum['smart'])}}
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2" style="text-align: right;">
                                        @if($Sum['cash']!=="")
                                            {{ number_format($Sum['cash'])}}
                                        @endif
                                    </td>

                                    <td class="border px-4 py-2" style="text-align: right;">{{ number_format($Sum['total'])}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                    {{ $PaymentHistories->links() }}
                     --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>