<table class="table"> 
	<thead>
		<tr>
			<th>Name</th>
			<th>Mobile No</th>
			<th>Contact No</th>
			<th>Logo</th>
			<th>Image</th>
		</tr>
	</thead>
	<tbody>
 
			 
		<tr>
			<td>{{ $SchoolDetail->name }}</td>
			<td>{{ $SchoolDetail->mobile }}</td>
			<td>{{ $SchoolDetail->contact }}</td>
			<td><img src="{{ route('admin.school.logo.show',Crypt::encrypt($SchoolDetail->logo)) }}" width="80px" height="80px" alt="" title="" /></td>
			<td><img src="{{ route('admin.school.logo.show',Crypt::encrypt($SchoolDetail->image)) }}" width="80px" height="80px" alt="" title="" /></td>
		</tr>
		 
	</tbody>
</table>
<hr>
<div class="col-lg-12">
	{!! $SchoolDetail->report_header !!}
</div>