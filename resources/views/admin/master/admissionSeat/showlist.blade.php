<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" id="admission_seat_table">
     <thead>
       <tr>
         <th>Academic Year</th>
         <th>Class</th>
         <th>Total Seat</th>
         <th>Prospectus Fee</th>
         <th>From Date</th>
         <th>Last Date</th>
         <th>Test Date</th>
         <th>Test Time</th>
         <th>Result Date</th>
         <th>Result Time</th>
         <th>Test Duration</th>
         <th>Retest Date</th>
         <th>Syllabus</th>
         <th>Action</th>
       </tr>
     </thead>
     <tbody>
      @foreach ($result_rs as $adminssionSeat)
        <tr>
          <td>{{ $adminssionSeat->ay_name}}</td>
          <td>{{ $adminssionSeat->class_name}}</td>
          <td>{{ $adminssionSeat->total_seat}}</td>
          <td>{{ $adminssionSeat->form_fee}}</td>
          <td>{{ date('d-m-Y',strtotime( $adminssionSeat->from_date))}}</td>
          <td>{{ date('d-m-Y',strtotime( $adminssionSeat->last_date))}}</td>
          <td>{{ date('d-m-Y',strtotime( $adminssionSeat->test_date))}}</td>
          <td>{{ $adminssionSeat->test_time}}</td>
          <td>{{ date('d-m-Y',strtotime( $adminssionSeat->result_date))}}</td>
          <td>{{ $adminssionSeat->result_time}}</td>
          <td>{{ $adminssionSeat->test_duration}}</td>
          <td>{{ date('d-m-Y',strtotime( $adminssionSeat->retest_date))}}</td>
          <td>
            <a href="{{ route('admin.adminssion.seat.download',Crypt::encrypt($adminssionSeat->id)) }}" target="blank" style="margin:10px">{{ $adminssionSeat->syllabus?'Download Syllabus!' : '' }}</a>
          </td>
          <td> 
              <a  onclick="callPopupLarge(this,'{{ route('admin.adminssion.sch.addform',Crypt::encrypt($adminssionSeat->id)) }}')" multi-select-popup="true" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
           
              <a success-popup="true" select-triger="academic_year_select_box" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.adminssion.seat.delete',Crypt::encrypt($adminssionSeat->id)) }}') } else{console_Log('cancel') }" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
          </td>
        </tr> 
      @endforeach
    </tbody>
  </table>
</div>