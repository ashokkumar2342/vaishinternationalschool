<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Sibling Info</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.sibling.store',$student_id) }}" method="post" class="add_form" button-click="btn_close,sibling_info_tab">
                {{ csrf_field() }}
                <div class="form-group">
                    {{ Form::label('student_sibling_id','Student Sibling Registration No',['class'=>'control-label']) }} 
                    <span class="fa fa-asterisk"></span> 
                    <input type="text" onblur="callAjax(this,'{{ route('admin.student.search.by.regsapp.details.show',1) }}','sibling_details')" name="sibling_registration_no" id="sibling_registration_no" class="form-control" maxlength="{{$reg_no_size}}" onkeypress='return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)'>
                </div>
                <div class="form-group" id="sibling_details"> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="save">
                </div>
            </form>  
        </div>
    </div>
</div>


