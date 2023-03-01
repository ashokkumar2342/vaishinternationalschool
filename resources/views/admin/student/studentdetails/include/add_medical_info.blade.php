<div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add/Edit Medical Detail</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-gray">
                        <tr>
                            <th class="text-nowrap">Student Name</th>
                            <th class="text-nowrap">Registration No.</th>
                            <th class="text-nowrap">Mobile No.</th>
                            <th class="text-nowrap">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $student[0]->name }}</td>
                            <td>{{ $student[0]->registration_no }}</td>
                            <td>{{ $student[0]->mobileno}}</td>
                            <td>{{ $student[0]->emailid }}</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.student.medical.store',Crypt::encrypt($student[0]->id)) }}" method="post" class="add_form" button-click="btn_close,medical_info_tab">
                {{ csrf_field() }} 
                <div class="row">
                    <input type="hidden" name="smi_id" value="{{ Crypt::encrypt(@$smi_result[0]->id) }}">    
                    <div class="form-group col-md-4">
                        <label>On Date</label>
                        <input type="date" name="ondate" class="form-control" value="{{@$smi_result[0]->ondate}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Blood Group</label>
                        <select name="bloodgroup_id" class="form-control">
                            <option selected disabled>Select Blood Group</option>
                            @foreach ($Bloodgroups as $Bloodgroup)
                            <option value="{{ $Bloodgroup->id }}"{{@$smi_result[0]->bloodgroup_id==$Bloodgroup->id?'selected':''}}>{{ $Bloodgroup->name }}</option>  
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group col-md-4">
                        <label>HB</label>
                        <input type="text" name="hb" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="3" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label>BP Lower</label>
                        <input type="text" name="bp_lower" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label>BP Upper</label>
                        <input type="text" name="bp_uper" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Weight (In kg)</label>
                        <input type="text" name="weight" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Height (In cm)</label>
                        <input type="text" name="height" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Vision</label>
                        <input type="text" name="vision" class="form-control" maxlength="50" value="{{@$smi_result[0]->hb}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Complexion</label>     
                        <select name="complextion" class="form-control">
                            <option selected disabled>Select Blood Group</option>
                            @foreach ($complextions as $complextion)
                            <option value="{{ $complextion->id }}"{{@$smi_result[0]->complextion==$complextion->id?'selected':''}}>{{ $complextion->name }}</option>  
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group col-md-4">
                        <label>Id Marks1</label>
                        <input type="text" name="id_marks1" class="form-control" maxlength="50" value="{{@$smi_result[0]->id_marks1}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Id Marks2</label>
                        <input type="text" name="id_marks2" class="form-control" maxlength="50" value="{{@$smi_result[0]->id_marks2}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Dental</label>
                        <input type="text" name="dental" class="form-control" maxlength="50" value="{{@$smi_result[0]->dental}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Allergy</label>
                        <select name="alergey" id="alergey" class="form-control" onchange="showHideDiv(this.value,'alergey_vacc_div')">
                            <option value="0">No</option>
                            <option value="1" {{@$smi_result[0]->isalgeric==1?'selected':''}}>Yes</option> 
                        </select>
                    </div>
                    <div style="display: none" id="alergey_vacc_div">
                        <div  class="form-group col-md-4" >
                            <label>Allergy Description</label>
                            <input type="text" name="alergey_desc"  class="form-control" maxlength="50" value="{{@$smi_result[0]->alergey}}">
                        </div>
                        <div  class="form-group col-md-4" >
                            <label>Allergy Vaccine</label>
                            <input type="text" name="alergey_vacc"  class="form-control" maxlength="50" value="{{@$smi_result[0]->alergey_vacc}}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Physical Handicapped</label>
                        <select name="physical_handicapped" id="physical_handicapped" onchange="showHideDiv(this.value,'narration_div')" class="form-control">
                            <option value="0">No</option>
                            <option value="1" {{@$smi_result[0]->ishandicapped==1?'selected':''}}>Yes</option> 
                        </select>
                    </div> 
                    <div style="display: none" id="narration_div">
                        <div class="form-group col-md-4">
                            <label>Handicapped Percent</label>
                            <input type="text" name="handicapped_parcent"  class="form-control" maxlength="3" value="{{@$smi_result[0]->handi_percent}}">
                        </div>  
                        <div class="form-group col-md-4" >
                            <label>Handicapped Description</label>
                            <input type="text" name="handicapped_desc" class="form-control" value="{{@$smi_result[0]->physical_handicapped}}">
                        </div> 
                    </div>
                    <div class="form-group col-md-8">
                        <label>Narration</label>
                        <input type="text" name="narration" class="form-control" value="{{@$smi_result[0]->narration}}">
                    </div> 
                    

                    <div class="form-group col-lg-12 text-center" style="margin-top: 10px">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    if ({{@$smi_result[0]->isalgeric}}==1) {
        $('#alergey').trigger('change');
    }
    if ({{@$smi_result[0]->ishandicapped}}==1) {
        $('#physical_handicapped').trigger('change');
    }
</script> --}}
