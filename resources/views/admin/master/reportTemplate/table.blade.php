<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($ReportTemplates as $ReportTemplate)
		<tr style="{{ $ReportTemplate->status==1?'background-color: #95e49b':'' }}">
			<td>{{ $ReportTemplate->name }}</td>
			<td>
				@if ($ReportTemplate->status==1)
					Default
				@else
					<a select-triger="report_type" success-popup="true" onclick="callAjax(this,'{{ route('admin.master.report.template.status',[Crypt::encrypt($ReportTemplate->id),Crypt::encrypt($ReportTemplate->reports_type_id)]) }}')" class="btn btn-xs btn-default">Set Default</a>
				@endif
				
			</td>
		</tr> 
		@endforeach
	</tbody>
</table>