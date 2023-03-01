<table class="table table-responsive table-striped table-hover " id="report_dataTable"> 
	<thead>
		<tr>
			 
			<th>Report For</th>
			<th>Report Wise</th>
			<th>Class</th>
			<th>Section</th> 
			<th>Action</th> 
		</tr>
	</thead>
	<tbody>
		@foreach ($reportRequests as $reportRequest)
				<tr> 
					@if ($reportRequest->report_type_id==1)
						 <td>Fee Certificate</td>
					@endif
					@if ($reportRequest->report_type_id==2)
						 <td>School Leaving Certificate</td>
					@endif
					@if ($reportRequest->report_type_id==3)
						 <td>Character Certificate</td>
					@endif
					@if ($reportRequest->report_wise==1) 
					      <td>All</td>
					@endif
					@if ($reportRequest->report_wise==3) 
					      <td>Class</td>
					@endif
					@if ($reportRequest->report_wise==4) 
					      <td>Class With Section</td>
					@endif 
					<td>{{ $reportRequest->classTypes->name or ''}}</td>
					<td>{{ $reportRequest->sectionTypes->name or ''}}</td>
					@if ($reportRequest->status==0)
						 <td> <span class="label label-warning">Pending</span></td>
					@endif
					@if ($reportRequest->status==1)
						 <td> <span class="label label-success">Success</span></td>
					@endif
					 @if ($reportRequest->status==0) 
					   <td><a href="" title="" disabled class="btn btn-xs btn-success"><i class="fa fa-download"></i></a></td>
					@endif
					@if ($reportRequest->status==1) 
					   <td><a href="{{ route('admin.student.report.request.pending.generate',[$reportRequest->id,$reportRequest->report_type_id]) }}" target="blank" title="" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a></td>
					@endif
				</tr> 
		@endforeach
	</tbody>
</table>