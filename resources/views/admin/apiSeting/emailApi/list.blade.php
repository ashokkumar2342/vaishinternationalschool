<table class="table" id="sms_list">
	<thead>
		<tr>
			<th class="text-nowrap">Sr.No.</th>
			<th class="text-nowrap">Host</th>
			<th class="text-nowrap">Port</th>
			<th class="text-nowrap">Username</th>
			<th class="text-nowrap">Password</th>
			<th class="text-nowrap">Encryption</th>
			<th class="text-nowrap">From</th>
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
					<td  class="text-nowrap">{{ $arrayId++ }}</td>
					<td  class="text-nowrap">{{ $smsApi->host }}</td>
					<td  class="text-nowrap">{{ $smsApi->port }}</td>
					<td  class="text-nowrap">{{ $smsApi->username }}</td>
					<td  class="text-nowrap">{{ $smsApi->password }}</td>
					<td  class="text-nowrap">{{ $smsApi->encryption }}</td>
					<td  class="text-nowrap">{{ $smsApi->mail_from }}</td>
					<td  class="text-nowrap">{{ $smsApi->enableautosend==1?'Yes' : 'No'}}</td>
					<td  class="text-nowrap">
						@if ($smsApi->status!=1 )
							<button class="btn btn-default btn-xs" style="width:60px" success-popup="true" button-click="btn_homework_table_show" onclick="callAjax(this,'{{ route('admin.api.status',[Crypt::encrypt($smsApi->id),2]) }}')">Activate</i></button>
						@endif
						@if ($smsApi->status==1 )
                         	<a href="#" onclick="callPopupLarge(this,'{{ route('admin.api.test.message',2) }}')" title="Test Message" class="btn btn-warning btn-xs">Test Message</a>
                        @endif
                        <button class="btn btn-info btn-xs" onclick="callPopupLarge(this,'{{ route('admin.api.emailApiAdd',Crypt::encrypt($smsApi->id))}}')" title="Edit"><i class="fa fa-edit"></i></button>
						  <a  href="#" success-popup="true" button-click="btn_homework_table_show" onclick="if (confirm('Are You Sure To Delete')){callAjax(this,'{{ route('admin.api.emailApidelete',Crypt::encrypt($smsApi->id)) }}') } else{console_Log('cancel') }"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> 
                        
					</td>
				</tr> 
		@endforeach
	</tbody>
</table>
