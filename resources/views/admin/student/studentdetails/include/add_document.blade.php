<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Add Document</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.student.document.store',$student_id) }}" class="add_form" method="post" button-click="documrnt_tab,btn_close"> 
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Document Type</label>
                    <select name="document_type_id" class="form-control">
                        <option selected disabled>Select Document Type</option>
                        @foreach ($documrnt_types as $documrnt_type)
                        <option value="{{ $documrnt_type->id }}">{{ $documrnt_type->name }}</option> 
                        @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label>Document</label>
                    <input type="file" name="document" class="form-control">
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="save">
                </div>
            </form>  
        </div>
    </div>
</div>


