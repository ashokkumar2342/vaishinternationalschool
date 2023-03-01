   
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ @$edit_admSch[0]->id?'Edit' : 'Add' }} Admission Schedule</h4>
      </div>
      <div class="modal-body"> 
            <form action="{{ route('admin.adminssion.seat.store',Crypt::encrypt(@$edit_admSch[0]->id)) }}" method="post" class="add_form"  button-click="btn_close" enctype="multipart/form-data" select-triger="academic_year_select_box">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-lg-6 form-group">
                  <label>Academic Year</label>
                  <span class="fa fa-asterisk"></span>
                  <select name="academic_year_id" class="form-control">
                    <option selected disabled> Select Academic Year</option>
                    @foreach ($ac_year as $academicYear)
                       <option value="{{ $academicYear->id }}"{{ @$edit_admSch[0]->academic_year_id==$academicYear->id?'selected':'' }}>{{ $academicYear->name }}</option> 
                    @endforeach 
                  </select> 
                </div> 
                <div class="col-lg-6 form-group">
                  <label>Class</label>
                  <span class="fa fa-asterisk"></span>
                  <select name="class_id" class="form-control">
                    <option selected disabled> Select Class</option>
                    @foreach ($classes as $classe)
                       <option value="{{ $classe->id }}"{{ @$edit_admSch[0]->class_id==$classe->id?'selected':'' }}>{{ $classe->name }}</option> 
                    @endforeach 
                  </select> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Total Seat</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="text" name="total_seat" class="form-control" placeholder="Enter Total Seat" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ @$edit_admSch[0]->total_seat }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Prospectus Fee</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="text" name="form_fee" class="form-control" placeholder="Enter Prospectus Fee"  maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ @$edit_admSch[0]->form_fee }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>From Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="from_date" class="form-control" value="{{ @$edit_admSch[0]->from_date }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Last Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="last_date" class="form-control" value="{{ @$edit_admSch[0]->last_date }}"> 
                </div> 
                <div class="col-lg-12 form-group">
                  <label>Admission Last Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="adm_last_date" class="form-control" value="{{ @$edit_admSch[0]->admission_last_date }}"> 
                </div> 
                <div class="col-lg-6 form-group">
                  <label>Test Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="test_date" class="form-control" value="{{ @$edit_admSch[0]->test_date }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Test Time</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="text" name="test_time" class="form-control" maxlength="10" value="{{ @$edit_admSch[0]->test_time }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Result Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="result_date" class="form-control" value="{{ @$edit_admSch[0]->result_date }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Result Time</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="text" name="result_time" class="form-control" maxlength="10" value="{{ @$edit_admSch[0]->result_time }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Test Duration</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="text" name="test_duration" class="form-control" maxlength="100" value="{{ @$edit_admSch[0]->test_duration }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Retest Date</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="date" name="retest_date" class="form-control" value="{{ @$edit_admSch[0]->retest_date }}"> 
                </div>
                <div class="col-lg-6 form-group">
                  <label>Required Subject</label>
                  <span class="fa fa-asterisk"></span>
                  <select class="multiselect form-control" multiple="multiple"  name="subject_id[]" required> 
                    
                    @foreach ($rs_test_subjects as $subjectType)
                    <option value="{{ $subjectType->id }}" {{$subjectType->selected == 1?"selected":""}}>{{ $subjectType->name }}</option> 
                    @endforeach   
                  </select>
                </div>
                <div class="col-lg-6 form-group">
                  <label>Required Documents</label>
                  <span class="fa fa-asterisk"></span>
                  <select class="multiselect form-control" multiple="multiple"  name="document_id[]" required> 
                    
                    @foreach ($rs_document_required as $documrnt_type)
                    <option value="{{ $documrnt_type->id }}" {{$documrnt_type->selected == 1?"selected":""}}>{{ $documrnt_type->name }}</option> 
                    @endforeach   
                  </select>
                </div> 
                <div class="col-lg-12 form-group">
                  <label>Syllabus (Only PDF , Size 1MB)</label>
                  <span class="fa fa-asterisk"></span>
                  <input type="file" name="syllabus" class="form-control" accept="application/pdf"> 
                </div>
                <div class="col-lg-12 form-group text-center" >
                   <input type="submit" class="btn btn-success">
                </div> 
              </div> 
              </form>  
            </div> 
        </div>
      </div>

     
    <!-- /.content -->

 
