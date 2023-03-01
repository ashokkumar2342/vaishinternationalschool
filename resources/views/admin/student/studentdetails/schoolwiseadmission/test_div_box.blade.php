<div class="col-lg-6 form-group">
  <label>Test Date</label>
  <span class="fa fa-asterisk"></span>
  <input type="date" name="test_date" class="form-control" value="{{$rs_exam_schedult[0]->test_date}}"> 
</div>
<div class="col-lg-6 form-group">
  <label>Test Time</label>
  <span class="fa fa-asterisk"></span>
  <input type="text" name="test_time" class="form-control" maxlength="10" value="{{$rs_exam_schedult[0]->test_time}}"> 
</div>
<div class="col-lg-6 form-group">
  <label>Result Date</label>
  <span class="fa fa-asterisk"></span>
  <input type="date" name="result_date" class="form-control" value="{{$rs_exam_schedult[0]->result_date}}"> 
</div>
<div class="col-lg-6 form-group">
  <label>Result Time</label>
  <span class="fa fa-asterisk"></span>
  <input type="text" name="result_time" class="form-control" maxlength="10" value="{{$rs_exam_schedult[0]->result_time}}"> 
</div>
<div class="col-lg-6 form-group">
  <label>Test Duration</label>
  <span class="fa fa-asterisk"></span>
  <input type="text" name="test_duration" class="form-control" maxlength="100" value="{{$rs_exam_schedult[0]->test_duration}}"> 
</div>
<div class="col-lg-6 form-group">
  <label>Prospectus Fee</label>
  <span class="fa fa-asterisk"></span>
  <input type="text" name="form_fee" class="form-control" placeholder="Enter Prospectus Fee"  maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{$rs_exam_schedult[0]->form_fee}}"> 
</div>