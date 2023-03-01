<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{{ @$result_rs[0]->id?'Edit' : 'Add' }} Admission Schedule</h4>
    </div>
    <div class="modal-body"> 
      <form action="{{ route('admin.adminssion.incharge.store',Crypt::encrypt(@$result_rs[0]->id)) }}" method="post" class="add_form"  button-click="btn_close" content-refresh="admission_incharge_table">
        {{ csrf_field() }}
        <div class="row"> 
          <div class="col-lg-12 form-group">
            <label>Class</label>
            <span class="fa fa-asterisk"></span>
            <select name="class_id" class="form-control">
              <option selected disabled> Select Class</option>
              @foreach ($classes as $classe)
                 <option value="{{ $classe->id }}"{{ @$result_rs[0]->class_id==$classe->id?'selected':'' }}>{{ $classe->name }}</option> 
              @endforeach 
            </select> 
          </div>
          <div class="col-lg-12 form-group">
            <label>Incharge Name</label>
            <span class="fa fa-asterisk"></span>
            <input type="text" name="incharge_name" class="form-control" placeholder="Enter Incharge Name" maxlength="50" value="{{ @$result_rs[0]->incharge_name }}"> 
          </div>
          <div class="col-lg-12 form-group">
            <label>Principal Name</label>
            <span class="fa fa-asterisk"></span>
            <input type="text" name="principal_name" class="form-control" placeholder="Enter Principal Name" maxlength="50" value="{{ @$result_rs[0]->principal_name }}"> 
          </div>
           
          <div class="col-lg-12 form-group text-center" >
             <input type="submit" class="btn btn-success">
          </div> 
        </div> 
      </form>  
    </div> 
  </div>
</div>

 
