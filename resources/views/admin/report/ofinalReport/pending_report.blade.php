<table class="table"> 
	<thead>
		<tr>
			<th>Report For</th>
			<th>Report Wise</th>
			<th>Class</th>
			<th>Section</th>
			<th>Section Name</th>
			<th>Field Name</th>
			<th>Document Marge</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($studentProfileReports as $studentProfileReport)
					<tr>
						<td>{{ $studentProfileReport->reportFor->name or ''}}</td>
						@if ($studentProfileReport->report_wise_id==1)
								<td>Section Wise</td> 
							@else	
						<td>Field Wise</td>
						@endif
						<td>{{ $studentProfileReport->classTypes->name or '' }}</td>
						<td>{{ $studentProfileReport->sectionTypes->name or '' }}</td>
						<td>{{ $studentProfileReport->section_name or '' }}</td>
						<td>{{mb_strimwidth($studentProfileReport->field_name , 0, 60, ".......") }}</td>
						@if ($studentProfileReport->document_marge==1) 
						   <td>Yes</td>
						   @else
						   <td>No</td>
						@endif
						 
						@if ($studentProfileReport->status==0)
						 <td> <span class="label label-warning">Pending</span></td> 
						@endif
						@if ($studentProfileReport->status==1)
						 <td> <span class="label label-success">Success</span></td> 
						@endif
						@if ($studentProfileReport->status==0)
						<td><a href="{{ route('admin.student.final.report.pending.download') }}" disabled title="Download" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a></td> 
						@endif
						@if ($studentProfileReport->status==1)
						<td><a href="{{ route('admin.student.final.report.pending.download') }}" title="Download" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a></td> 
						@endif
						 
					</tr> 
		@endforeach
	</tbody>
</table>