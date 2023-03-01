<div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" id="btn_close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><b>{{ @$rs_bgroup->id? 'Edit' : 'Add'}} </b>&nbsp;<i class="small text-muted">Blood Group</i></h4> 
  </div>
  <div class="modal-body">
    <form id="act_add" content-refresh="dataTable" button-click="btn_close" method="post" action="{{ route('admin.bloodgroup.update',Crypt::encrypt(@$rs_bgroup->id?@$rs_bgroup->id:0)) }}" class="add_form" no-reset="true" button-click="btn-submit">
     {{ csrf_field() }}
      <div class="row" style="padding-bottom: 30px;"> 
        <div class="col-lg-12">                           
          <div class="form-group">
            <label>Blood Group </label>
            <input type="text" name="name" value="{{ @$rs_bgroup->name }}" maxlength="10" class="form-control" placeholder="Enter Group Name " required="">
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
