 
	 
<div class="panel panel-default">
  <div class="panel-heading"></div>
  <div class="panel-body">
  	<table class="table"> 
	<thead>
		<tr>
			<th>Name</th>
			<th>Mobile No</th>
			<th>E-mail ID</th>
			<th>Address</th> 
			 
		</tr>
	</thead>
	<tbody>
		<input type="hidden" name="relation_id" value="{{ $relation_type_id }}">
		 @foreach ($parentInfos as $parentInfo)
			<tr>
				<td>{{ $parentInfo->name }}</td>
				<td>{{ $parentInfo->mobile }}</td>
				<td>{{ $parentInfo->email }}</td>
				<td>{{ $parentInfo->office_address }}</td>
				<td><input type="radio" name="perent_info_id" value="{{ $parentInfo->id }}"></td>

			</tr> 
		@endforeach
	</tbody>
</table>
<div class="col-lg-12 text-center" >
<input type="submit" class="btn btn-success" style="margin: 10px"> 
</div>
</div>
  </div>

 