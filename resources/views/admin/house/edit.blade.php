<div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" id="btn_close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><b>{{ @$house->id? 'Edit' : 'Add'}} </b>&nbsp;<i class="small text-muted">House</i></h4> 
  </div>
  <div class="modal-body">
     <form id="act_add" content-refresh="dataTable" button-click="btn_close" method="post" action="{{ route('admin.houses.update',Crypt::encrypt(@$house->id?@$house->id:0)) }}" class="add_form" no-reset="true" button-click="btn-submit">
     {{ csrf_field() }}
    <div class="row" style="padding-bottom: 30px;">
       
       <div class="col-lg-12">                           
            <div class="form-group">
             <label>House Name </label>
                     <input type="text" name="name" value="{{ @$house->name }}" maxlength="50" class="form-control" placeholder="Enter House Name " required="">
            </div>    
       </div>
       <div class="col-lg-12">                           
            <div class="form-group">
             <label>Code </label>
                     <input type="text" name="code" value="{{ @$house->code }}" maxlength="5" class="form-control" placeholder="Enter Code " required="">
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
