<button type="button" class="btn btn-info btn-sm btn_add_sport_hobby" style="margin: 10px" onclick="callPopupLarge(this,'{{ route('admin.student.sports.add',$student_id) }}')">Add Sport/Hobbies</button>
<div class="table-responsive">
	<table class="table table-striped table-bordered" id="sport_hobby_items">                         
		<thead>
			<tr>
				<th class="text-nowrap">Sr.No.</th>
				<th class="text-nowrap">Academic Year (Session)</th>
				<th class="text-nowrap">Sports Activity Name</th>
				<th class="text-nowrap">Level</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@php
			$arrayId=1;
			@endphp
			@foreach ( $sportHobbies as $sportHobby) 
			<tr>
				<td>{{ $arrayId++ }}</td>
				<td>{{$sportHobby->academic_year }}</td>
				<td>{{$sportHobby->sports_activity_name }}</td>
				<td>{{$sportHobby->award_level }}</td>
				<td>
					<button class="btn_sport_hobby_edit btn btn-warning btn-xs"  onclick="callPopupLarge(this,'{{ route('admin.student.sports.edit',Crypt::encrypt($sportHobby->id)) }}')"><i class="fa fa-edit"></i></button>

					<button class="btn btn-danger btn-xs" success-popup="true" button-click="sport_hobbies_tab" title="Delete" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.student.sports.delete',Crypt::encrypt($sportHobby->id)) }}') } else{console_Log('cancel') }"  ><i class="fa fa-trash"></i></button> 
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>