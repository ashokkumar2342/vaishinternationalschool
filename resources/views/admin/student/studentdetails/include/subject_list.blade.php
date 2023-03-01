<button type="button" class="btn btn-info btn-sm add_subject" style="margin: 10px" onclick="callPopupLarge(this,'{{ route('admin.studentSubject.add',$studentId) }}')" >Add Subject</button>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Subject Details</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table" id="subject_items">                         
                    <thead>
                        <tr>
                            <th class="text-nowrap">Subject Name</th>
                            <th class="text-nowrap">Compulsory/Optional</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentSubjects as $studentSubject)
                        <tr>
                            <td>{{ $studentSubject->name}}</td>
                            <td>{{ $studentSubject->is_compulsory}}</td>                             
                            <td>
                                <a class="btn btn-danger btn-xs" success-popup="true" button-click="subject_tab" title="Delete" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.studentSubject.delete',Crypt::encrypt($studentSubject->id)) }}') } else{console_Log('cancel') }"  ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>