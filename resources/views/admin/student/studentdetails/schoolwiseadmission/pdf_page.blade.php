<!DOCTYPE html>
<html>
<title>
	
</title>
<body>
	@php
		$logo = storage_path('app/logo/Logo_vaish_Model1.jpg')
	@endphp
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="width: 100%;text-align: right;"><b>+91 - 7056754742, 01664 - 242386,254742</b></td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="font-size: 24px;"><b>VAISH MODEL SENIOR SECONDARY SCHOOL, BHIWANI</b></td>
			</tr> 
		</tbody>
	</table>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="" rowspan="1"><img src="{{$logo}}" width="80px" height="80px"></td>
				<td style="font-size: 18px;" align="center"><b>Affiliated to C.B.S.E. Delhi <br> ( Co-Education with English and Hindi Medium) <br>{{$adm_app_rs[0]->year_name}}</b></td>
				<td style="border: 1px solid black;" rowspan="2" width="117px" height="132px"><img src="{{$image}}" width="111px" height="116px"></td>
			</tr> 
			<tr>
				<td><b>Dear Sir/Madam</b></td> 
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td>We are pleased to in form you that name of your ward <b>{{$student_rs[0]->stu_name}}</b> S/o / D/o <b>{{$adm_app_rs[0]->fathers_name}}</b> has been registration for seeking admission to class <b>{{$adm_app_rs[0]->class_name}}</b> in this school for the current session.</td>
				<td style="border: 1px solid black;text-align: center;" width="117px" height="132px"> Affix passport size photograph here Don't Staple</td>
			</tr>
			<tr>
				<td>In this connection, your are requested to note the following :-</td>
			</tr>
		</tbody>
	</table>
	<table style="width:100%">
		<tr>
			<td style="width:20%">&nbsp;</td>
			<td style="width: 60%; text-align: center;background-color: black;color: #fff;"><b>SCHEDULE FOR THE ENTRANCE TEST</b></td>
			<td style="width:20%">&nbsp;</td>
		</tr>
	</table>
	<table style="width: 100%;border-collapse: collapse;" border="1">
		<tbody>
			<tr>
				<td style="width: 100%;">
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td style="text-align: center;width: 30%;"><u>STREAM/BRANCH</u></td>
								<td style="text-align: center;width: 30%;"><u>MEDIUM</u></td>
								<td style="text-align: center;width: 40%;"><u>SUBJECTS OF EXAMINATION</u></td>
							</tr>
						</tbody>
					</table>
					<table style="width: 100%;">
						<tbody>
							<tr>
								<td style="text-align: center;width: 30%;"><b>For {{$adm_app_rs[0]->class_name}}</b></td>
								<td style="text-align: center;width: 30%;"><b>{{$adm_app_rs[0]->medium_name}}</b></td>
								<td style="text-align: center;width: 40%;"><b>{{$subjects}}</b></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;border-collapse: collapse;margin-top: 10px;" border="1">
		<tbody>
			<tr>
				<td style="width: 100%;">
					<table style="width:100%;">
						<tbody>
							<tr>
								<td align="left"><b>Date of Entrance Test : {{ date('d-m-Y', strtotime($adm_app_rs[0]->test_date)) }}</b></td>
								<td align="right"><b>Time : {{$adm_app_rs[0]->test_time}}</b></td>
							</tr> 
						</tbody>
					</table>
					<table style="width:100%;">
						<tbody>
							<tr>
								<td align="center"><b>( Duration of Exam :: {{ $adm_app_rs[0]->test_duration }} )</b></td>
							</tr> 
						</tbody>
					</table>
				</td> 
			</tr>
		</tbody>
	</table>
	<table style="width:100%;">
		<tbody>
			<tr>
				<td style="text-justify">Please ensure that your ward reports on the specific date and time for the test. At the time of written test this proforma must be produced by the student, otherwise he/she will not be allowed to sit in the admission test. Result will be displayed on the school notice board as per follows : -</td> 
			</tr> 
		</tbody>
	</table>
	<table style="width: 100%;text-align: center;">
		<tbody>
			<tr>
				<td><b><u>Class</u></b></td>
				<td><b><u>Result Date</u></b></td>
				<td><b><u>Result Time</u></b></td>
			</tr>
			<tr>
				<td>{{$adm_app_rs[0]->class_name}}</td>
				<td>{{ date('d-m-Y', strtotime($adm_app_rs[0]->result_date)) }}</td>
				<td>{{$adm_app_rs[0]->result_time}}</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td><b><u>Required Document</u></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					@foreach ($document_rs as $val_document)
						{{$val_document->name}} <br>
					@endforeach
				</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;margin-top: 10px;">
		<thead>
			<tr>
				<td style="text-align: center;width: 30%;"><b>({{$incharge_name}}) <br><u>I/C Admission</u></b></td>
				<td style="text-align: center;width: 40%;">&nbsp;</td>
				<td style="text-align: center;width: 30%;"><b>({{$principal_name}}) <br><u>Principal</u></b></td>
			</tr> 
		</thead>
	</table>
	<hr style="height: 1.5px;color: black;padding-top:20px;">
	<table style="width: 100%;text-align: center;border-collapse: collapse;" border="1">
		<thead>
			<tr>
				<th style="height:30px">Application No.</th>
				<th style="height:30px">Date</th>
				<th style="height:30px">Amount Paid</th>
				<th style="height:30px">Sign. Office Clerk</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="height:40px">{{$adm_app_rs[0]->id}}</td>
				<td style="height:40px">{{ date('d-m-Y', strtotime($adm_app_rs[0]->application_date)) }}</td>
				<td style="height:40px">{{$adm_app_rs[0]->form_fee}}</td>
				<td style="height:40px"></td>
			</tr>
		</tbody>
	</table>

</body>
</html>