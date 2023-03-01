<div class="table-responsive"> 
    <table  class="table table-bordered table-striped table-hover" id="student_app_list_data_table">
        <thead>
            <tr>               
                <th>Academic Year</th>
                <th>Student Name</th>
                <th>Class</th>  
                <th>Father Name</th>  
                <th>Application Date</th>  
                <th>Medium</th>  
                <th width="100px">Action</th>                  
            </tr>
        </thead>
        <tbody>
            @foreach($adm_app_list as $student) 
            <tr>
                <td>{{ $student->year_name }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->class_name }}</td>
                <td>{{ $student->fathers_name }}</td>
                <td>{{ $student->application_date }}</td>
                <td>{{ $student->medium_name }}</td>
                <td>
                    <a class="btn btn-info btn-xs"  title="Edit Student" href="{{ route('admin.student.school.edit.adm.app.edit',Crypt::encrypt($student->student_id)) }}" target="_blank"><i class="fa fa-edit"></i>
                </td> 
            </tr> 
            @endforeach
        </tbody> 
    </table>
</div> 
