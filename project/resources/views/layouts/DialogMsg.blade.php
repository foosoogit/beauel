@extends('layouts.appCustomer')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><span class="border border-success bg-success text-white rounded h5">&nbsp;{{session('target_branch_name')}}&nbsp;</span>新規顧客登録完了メッセージ</div>
				@if(session('target_branch_name')=="")
					<p class="display-1 text-danger">店舗が選択されていません。</p>
				@endif
				<div class="card-body">
					{!!$msg!!}
					<ul class="my-3">
					
						{{-- @if (session('target_branch_serial')!=="01") --}}
							<li>
								<form method="GET" action="{{route('customers.ShowInpKeiyaku.get',['serial_user' => $targetSerial])}}">@csrf
									<button class="btn btn-primary" type="submit">続けて契約書を作成</button>
								</form>
							</li>
						{{-- @endif --}}
					
						{{--  @if (session('target_branch_serial')==="01")
							<li> 
									<form method="GET" action="{{route('customers.ShowPaymentRegistrationIflame',['SerialKeiyaku' => 0,'SerialUser' => $targetSerial])}}">@csrf

									<button class="btn btn-primary" type="submit">続けて入金、来店記録を入力</button>
								</form>
							</li>
						@endif--}}
						<li class="my-3">
							<button type="button" class="btn btn-primary" onClick="history.back()">前画面に戻る</button>
						</li>
						{{-- 
						<li>
							<form method="GET" action="/customers/ShowInpContract/{{$targetSerial}}">@csrf
								<button class="btn btn-primary btn-sm" type="submit">顧客一覧</button>
							</form>
						</li><br>
						 --}}
						<li class="my-3">
							<form method="GET" action="{{route('customers.ShowInpNewCustomer')}}">@csrf
								<button class="btn btn-primary" type="submit">新規顧客追加</button>
							</form>
						</li>
						<li class="my-3">
							<form method="GET" action="{{ route('customers.CustomersList.show') }}">@csrf
								<button class="btn btn-primary btn-sm" type="submit">顧客一覧</button>
							</form>
						</li>
						<li class="my-3">
							<form method="GET" action="{{route('admin.top')}}">@csrf
								<button class="btn btn-primary" type="submit">メニューに戻る</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection