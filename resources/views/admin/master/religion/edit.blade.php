<div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" id="btn_close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><b>{{ @$rs_religion->id? 'Edit' : 'Add'}} </b>&nbsp;<i class="small text-muted">Religion</i></h4> 
  </div>
  <div class="modal-body">
    <form id="act_add" content-refresh="dataTable" button-click="btn_close" method="post" action="{{ route('admin.religion.update',Crypt::encrypt(@$rs_religion->id?@$rs_religion->id:0)) }}" class="add_form" no-reset="true" button-click="btn-submit">
     {{ csrf_field() }}
      <div class="row" style="padding-bottom: 30px;"> 
        <div class="col-lg-12">                           
          <div class="form-group">
            <label>Religion Name </label>
            <input type="text" name="name" value="{{ @$rs_religion->name }}" maxlength="50" class="form-control" placeholder="Enter Religion Name " required="">
          </div>    
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Code </label>
            <input type="text" name="code" value="{{ @$rs_religion->code }}" maxlength="2" class="form-control" placeholder="Enter Code " required="">
          </div>    
        </div>
        <div class="col-lg-12">
          <div class="text-center"><br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success btn-sm" name="update" id="btn-update">  
          </div>
        </div>
      </div> 
     
     
    </form>
                 
  </div>
</div>
