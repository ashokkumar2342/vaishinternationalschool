<div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" id="btn_close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><b>{{ @$rs_award->id? 'Edit' : 'Add'}} </b>&nbsp;<i class="small text-muted">Award Level</i></h4> 
  </div>
  <div class="modal-body">
     <form id="act_add" content-refresh="dataTable" button-click="btn_close" method="post" action="{{ route('admin.award.level.update',Crypt::encrypt(@$rs_award->id?@$rs_award->id:0)) }}" class="add_form" no-reset="true" button-click="btn-submit">
     {{ csrf_field() }}
    <div class="row" style="padding-bottom: 30px;">
       
       <div class="col-lg-12">                           
            <div class="form-group">
             <label>Award Level </label>
                     <input type="text" name="name" value="{{ @$rs_award->name }}" maxlength="50" class="form-control" placeholder="Enter Award Level " required="">
            </div>    
       </div>
       <div class="col-lg-12">                           
            <div class="form-group">
             <label>Code </label>
                     <input type="text" name="code" value="{{ @$rs_award->code }}" maxlength="5" class="form-control" placeholder="Enter Code " required="">
            </div>    
       </div>
       <div class="col-lg-12">
         <div class="text-center"><br>
             <input type="submit" class="btn btn-success btn-sm" name="update" id="btn-update">
              
           </div>
       </div>
      </div> 
     
     
     </form>
                 
    </div>
  </div>
