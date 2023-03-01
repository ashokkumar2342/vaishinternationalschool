<div class="form-group">
    <label>Subject</label>
    <span class="fa fa-asterisk"></span><br>
    <select class="multiselect form-control" multiple="multiple"  name="subject_id[]">
    @foreach ($rs_subjects as $subjectType)
        <option value="{{ $subjectType->id }}" {{$subjectType->selected == 1?"selected":""}}>{{ $subjectType->name }}</option> 
    @endforeach
    </select>
</div>
