<div class="table-responsive">
<table class="table" id="sms_list">
	<thead>
		<tr>
			<th class="text-nowrap">Sr.No.</th>
			<th class="text-nowrap">User Name</th>
			<th class="text-nowrap">Password</th>
			<th class="text-nowrap">Sender Name</th>
			<th class="text-nowrap">Url</th>
			<th class="text-nowrap">Enable Auto Send</th>
			<th class="text-nowrap text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@php
			$arrayId=1;
		@endphp
		@foreach ($smsApis as $smsApi)
				<tr style="{{ $smsApi->status==1?'background-color: #95e49b':'' }}">
					<td class="text-nowrap">{{ $arrayId++ }}</td>
					<td class="text-nowrap">{{ $smsApi->user_id }}</td>
					<td class="text-nowrap">{{ $smsApi->password }}</td>
					<td class="text-nowrap">{{ $smsApi->sender_id }}</td>
					<td class="text-nowrap">{{ $smsApi->url }}</td>
					<td class="text-nowrap">{{ $smsApi->enableautosend==1?'Yes' : 'No'}}</td>
					<td class="text-nowrap">
						@if ($smsApi->status!=1 )
							<a class="btn btn-default btn-xs" success-popup="true" button-click="btn_outhor_table_show" style="width:60px" onclick="callAjax(this,'{{ route('admin.api.status',[Crypt::encrypt($smsApi->id),1]) }}')">Activate</i></a>
						@endif
						
						@if ($smsApi->status==1 )
							<a href="#" onclick="callPopupLarge(this,'{{ route('admin.api.test.message',1) }}')" title="Test Message" class="btn btn-warning btn-xs">Test Message</a>
						@endif
						<button class="btn btn-info btn-xs" onclick="callPopupLarge(this,'{{ route('admin.api.smsApiAdd',Crypt::encrypt($smsApi->id)) }}')" title="Edit"><i class="fa fa-edit"></i></button>
						
						<a  href="#" success-popup="true" button-click="btn_outhor_table_show" onclick="if (confirm('Are You Sure To Delete')){callAjax(this,'{{ route('admin.api.smsApidelete',Crypt::encrypt($smsApi->id)) }}') } else{console_Log('cancel') }"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> 
                        
					</td>
				</tr> 
		@endforeach
	</tbody>
</table>
