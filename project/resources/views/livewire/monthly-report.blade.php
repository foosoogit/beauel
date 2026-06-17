<div class="container text-center">
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="pb-4 justify-content-center align-middle">
                <div class="row">
					@include('layouts.header')
				</div>
                <div class="mb-2 bg-info text-white"><span class="border border-success bg-success text-white rounded h5">&nbsp;{{session('target_branch_name')}}&nbsp;</span>&nbsp;&nbsp;月報</div>
				@if(session('target_branch_name')=="")
					<p class="display-1 text-danger">店舗が選択されていません。</p>
				@endif
				<div class="card-header">
                    <div class="row">
						<div class="col-auto">
							<form method="POST" action="{{route('admin.MonthlyReport.post')}}" name="ChangeTargetMonth_fm" id="ChangeTargetMonth_fm">@csrf
                        		<h3>売上単価・現金比率<select name="year" onchange="ChangeTargetMonth();">{!!$html_year_slct!!}</select> <select name="month" onchange="ChangeTargetMonth();"><option  value="0" >選択</option>{!!$html_month_slct!!}</select></h3>
                    		</form>
						</div>
						<div class="col-auto">	
							<button class="btn mb-2 btn btn-outline-primary fs-5" onclick="ChangeShowClm(this);">詳細表示</button>
						</div>
					</div>
				</div>
				<div class="card-body">
					{!! $RaitenReason !!}
					{{--<form method="POST" action="/admin/ShowDailyReport_from_monthly_report">@csrf--}}
                    <form method="POST" action="{{route('admin.DailyReport.post')}}">@csrf
					    {!! $monthly_report_table !!}
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
