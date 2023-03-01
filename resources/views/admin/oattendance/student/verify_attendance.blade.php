 @php
    $studentattendancesclass=App\Model\StudentAttendanceClass::where('class_id',$class)->where('section_id',$section)->where('date',date('Y-m-d',strtotime($date)))->first();

  @endphp 
<div class="col-lg-12">
   Attendance Mark By :-> <b>{{ $studentattendancesclass->admins->first_name or '' }}</b> 
</div>
<div class="col-lg-12" style="margin-top: 5px"> 
   Attendance Verified By :-> <b>{{ $studentattendancesclass->verifieds->first_name or '' }}</b> 
</div>
<div class="col-lg-12" style="margin-top: 10px"> 
  @if (!empty($studentattendancesclass->verified_by))
    <button type="button" success-popup="true" button-click="btn_virify_show" class="btn btn-danger btn-sm" onclick="callAjax(this,'{{ route('admin.attendance.student.verify.unlock',$studentattendancesclass->id) }}')">Unlock</button>
    @endif

<table class="table table-bordered"> 
 
 <thead>                  
     <tr>
        <td><b>Registration No.</b></td>
        <td><b>Student Name</b> </td>
         @foreach ($attendancesTypes as $attendancesType)
         <th><button type="button" onclick="callChecked(this)" data-click="{{ $attendancesType->name }}" class="btn btn-{{ $attendancesType->color }} btn-xs"><i class="fa fa-check"></i>{{ $attendancesType->name }}</button> </th> 
         @endforeach  
    </tr>
 </thead>
 <tbody> 
 @foreach ($students as $student)
          @if (!empty($studentattendancesclass->verified_by)) 
           @php 
            $success = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'verified_attendance_type_id'=>1,'date'=>date('Y-m-d',strtotime($date))]))->first();
            @endphp
            @php
            $danger = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'verified_attendance_type_id'=>2,'date'=>date('Y-m-d',strtotime($date))]))->first();
            @endphp 
            @php
            $warning = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'verified_attendance_type_id'=>3,'date'=>date('Y-m-d',strtotime($date))]))->first();
            @endphp
            @endif
            @if (empty($studentattendancesclass->verified_by)) 
            @php 
            $success = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'attendance_type_id'=>1,'date'=>date('Y-m-d',strtotime($date))]))->first();
            @endphp
            @php
            $danger = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'attendance_type_id'=>2,'date'=>date('Y-m-d',strtotime($date))]))->first();
            @endphp 
            @php
            $warning = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'attendance_type_id'=>3,'date'=>date('Y-m-d',strtotime($date))]))->first(); 
            
            @endphp
          @endif  
          @php
             $color ='';
            if(!empty($success)){
              $color = 'lebel label-success';
            }else if(!empty($danger)){
              $color = 'lebel label-danger';
            }else if(!empty($warning)){
               $color = 'lebel label-warning';
            }
           // else if(empty($success)){
           //    $color = 'lebel label-success';
           //  }else if(empty($danger)){
           //    $color = 'lebel label-danger';
           //  }else if(empty($warning)){
           //     $color = 'lebel label-warning';
           //  }
          @endphp
        <tr id="tr-{{ $student->id }}" class="{{ $color }}"  color-change="true">
          <td>{{ $student->registration_no }}</td>
          
          <input type="hidden" name="date" value="{{ $date }}">
          <input type="hidden" name="class_id" value="{{ $student->class_id }}">
          <input type="hidden" name="section_id" value="{{ $student->section_id }}">
          <td>{{ $student->name }}</td>
            @foreach($attendancesTypes as $attendancesType)
          @if (!empty($studentattendancesclass->verified_by)) 
            @php
            $checked = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'verified_attendance_type_id'=>$attendancesType->id,'date'=>date('Y-m-d',strtotime($date))])->count())?'checked':'';
            @endphp
            @endif
             @if (empty($studentattendancesclass->verified_by)) 
            @php
            $checked = (\App\Model\StudentAttendance::where(['student_id'=>$student->id,'attendance_type_id'=>$attendancesType->id,'date'=>date('Y-m-d',strtotime($date))])->count())?'checked':'';
            @endphp
            @endif  
                    <td>
                    <label class="radio-inline">
                      <input type="radio" {{ $checked }} id="{{ $attendancesType->name }}{{ $student->id }}" onclick="$('#subject{{ $student->id }}').prop('checked', true);
                      if(this.value==1){
                        $('#tr-{{ $student->id }}').removeClass('lebel label-danger')
                        $('#tr-{{ $student->id }}').removeClass('lebel label-warning')
                        $('#tr-{{ $student->id }}').addClass('lebel label-success')
                      }else if(this.value==2){
                        $('#tr-{{ $student->id }}').addClass('lebel label-danger')
                         $('#tr-{{ $student->id }}').removeClass('lebel label-success')
                        $('#tr-{{ $student->id }}').removeClass('lebel label-warning')

                      }else if(this.value==3){
                        $('#tr-{{ $student->id }}').removeClass('lebel label-danger')
                         $('#tr-{{ $student->id }}').removeClass('lebel label-success')
                        $('#tr-{{ $student->id }}').addClass('lebel label-warning')

                      }
                      " class="{{ str_replace(' ', '_', strtolower($attendancesType->name)) }}" name="attendenceType_id[{{ $student->id }}]"  value="{{ $attendancesType->id }}">{{ $attendancesType->name }}</label>
                    </td>  
                     
          @endforeach
      </tr>
  
 @endforeach                     
 </tbody>
<tfoot> 
  @if (empty($studentattendancesclass->verified_by))
  @if (!empty($studentattendancesclass))
    @if ($studentattendancesclass->verified!=1) 
    <tr>
        <td colspan="5">                                 
          <div class="row">                              
           <div class="col-md-12 text-center">
            <button class="btn btn-success " id="subjectBtn">Verified Attendance</button>
           </div>
          </div>  
        </td>
     </tr>
      @endif 
      @endif 
  @endif
</tfoot>
</tbody>
</table>
 
 </div>



 