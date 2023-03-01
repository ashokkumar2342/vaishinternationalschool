<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ @$sportHobbies[0]->id?'Edit' : 'Add' }} Sport/Hobbies</h4>
        </div>
        <div class="modal-body"> 
            <form  action="{{ route('admin.student.sports.store',Crypt::encrypt(@$sportHobbies[0]->id)) }}"  method="post" button-click="btn_close,sport_hobbies_tab" content-refresh="parents_items" class="add_form">
                {{ csrf_field() }}
                <div class="row">
                    <input type="hidden" name="student_id" value="{{ @$student_id }}"> 
                    <div class="col-lg-12 form-group">
                        <label>Academic Year</label>
                        <select name="academic_year" class="form-control">
                            @foreach ($academicYears as $awardLevel)
                            <option value="{{ $awardLevel->id }}" {{ @$sportHobbies[0]->session_id==$awardLevel->id? 'selected' : '' }}>{{ $awardLevel->name }}</option> 
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-lg-12 form-group ">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            @foreach ($awardLevels as $awardLevel)
                            <option value="{{ $awardLevel->id }}"{{ @$sportHobbies[0]->award_level==$awardLevel->id? 'selected' : '' }}>{{ $awardLevel->name }}</option> 
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-lg-12 form-group ">
                        <label>Sports Activity Name</label>
                        <input type="text" name="sports_activity_name" class="form-control" maxlength="200" placeholder="Enter Sports Activity Name" value="{{ @$sportHobbies[0]->sports_activity_name }}">
                    </div>
                    <div class="col-lg-12 form-group text-center">
                        <input type="submit" class="btn btn-success" style="margin-top: 24px">
                    </div>
                </div>
            </form>
        </div>
    </div>   
</div>