
<div class="modal-dialog">
    <div class="modal-content" style="padding:10px;margin-top: -20px">
        <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
        <div class="panel panel-default">
            <div class="panel-heading"><b>Student's Details</b></div>
            <div class="panel-body">
                <table style="border-collapse: collapse; width:100%;" border="1">
                    <tbody>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Name</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ $student[0]->name }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Nick Name</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ $student[0]->nick_name }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Class</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ $student[0]->class }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Registration No.</td>
                            <td style="width: 30%;padding-left: 3px;"><b>{{ $student[0]->registration_no }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Admission No.</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$student[0]->admission_no}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Roll No.</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$student[0]->roll_no}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Admission Date</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ date('d-m-Y',strtotime($student[0]->date_of_admission)) }}</b></td>
                        </tr> 
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Date of Birth</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ date('d-m-Y',strtotime($student[0]->dob)) }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
        <div class="panel panel-default">
            <div class="panel-heading"><b>Parent's Details</b></div>
            <div class="panel-body">
                @foreach ($rs_parentInfo as $rs_value) 
                <div class="panel-heading text-center"><b>{{$rs_value->relation}}'s Details</b></div> 
                <table style="border-collapse: collapse; width:100%;" border="1">
                    <tbody>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Name</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->name}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Mobile No.</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->mobile}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Date of Birth</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{date('d-m-Y',strtotime($rs_value->dob))}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Date of Anniversary</td>
                            <td style="width: 30%;padding-left: 3px;"><b>{{date('d-m-Y',strtotime($rs_value->doa))}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Education</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->education}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Profession</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->profession}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Annual Income </td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->income}}</b></td>
                        </tr> 
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Alive</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$rs_value->islive}}</b></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div> 
        <div class="panel panel-default">
            <div class="panel-heading"><b>Medical Details</div>
            <div class="panel-body">
                @foreach ($rs_medicals as $medicalInfo)
                <div class="panel-heading text-center"><b>{{ Carbon\Carbon::parse($medicalInfo->ondate)->format('d-m-Y') }}</b></div>
                <table style="border-collapse: collapse; width:100%;" border="1">
                    <tbody>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">On Date</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ Carbon\Carbon::parse($medicalInfo->ondate)->format('d-m-Y') }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Blood Group</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ $medicalInfo->blood_group}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">HB</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{ $medicalInfo->hb }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">BP</td>
                            <td style="width: 30%;padding-left: 3px;"><b>{{ $medicalInfo->bp_uper }}/{{ $medicalInfo->bp_lower }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Height</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$medicalInfo->height}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Weight</td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$medicalInfo->weight}}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Complexion </td>
                            <td style="width: 70%;padding-left: 3px;"><b>{{$medicalInfo->complextion_name}}</b></td>
                        </tr> 
                        <tr>
                            <td style="width: 30%;padding-left: 3px;">Alive</td>
                            <td style="width: 70%;padding-left: 3px;"><b></b></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div> 
        <div class="panel panel-default">
            <div class="panel-heading">Sibling's Details</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Sibling Registration No.</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $arrayId=1;
                            @endphp
                            @foreach ($rs_siblings as $val_siblings)
                            <tr>
                                <td>{{ $arrayId++ }}</td>
                                <td>{{ $val_siblings->registration_no}}</td>
                                <td>{{ $val_siblings->student_name}}</td>
                                <td>{{ $val_siblings->class_name}}</td>
                                <td>{{ $val_siblings->student_status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Subject's Details</div>
            <div class="panel-body">
                <div class="row">
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Compulsory/Optional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentSubjects as $studentSubject)
                            <tr>
                                <td> {{ $studentSubject->name }}</td>
                                <td>{{ $studentSubject->is_compulsory}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>          
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Sport's Details</div>
            <div class="panel-body">
                <div class="row">
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th>Academic Year</th>
                                <th>Sports Activity Name</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($StudentSportHobbys as $StudentSportHobby)
                            <tr>
                                <td>{{$StudentSportHobby->sessions->name or ''  }}</td>
                                <td>{{ $StudentSportHobby->sports_activity_name }}</td>
                                <td>{{ $StudentSportHobby->awardLevel->name or '' }}</td>
                            </tr>
                             @endforeach  --}}

                        </tbody>
                    </table>
                </div>
            </div>          
        </div>
    </div>
</div>