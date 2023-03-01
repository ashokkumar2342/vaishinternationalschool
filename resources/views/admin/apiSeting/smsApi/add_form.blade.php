   
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ @$smsApi->id? 'Edit' : 'Add' }} SMS API</h4>
      </div>
      <div class="modal-body"> 
             <form action="{{ route('admin.api.smsApiStore',Crypt::encrypt(@$smsApi->id?@$smsApi->id:0)) }}" method="post" class="add_form" button-click="btn_outhor_table_show,btn_close">
                   {{ csrf_field() }}
                   <div class="row"> 
                    <div class="form-group   col-lg-4">
                      <label>User Name</label>
                      <input type="text" name="user_name" class="form-control" placeholder="Enter Username" maxlength="50"  value="{{ @$smsApi->user_id }}" required=""> 
                    </div> 
                    <div class="form-group   col-lg-4">
                      <label>Password</label>
                      <input type="pasword" name="password" class="form-control" maxlength="50" placeholder="Enter Password"  value="{{ @$smsApi->password }}" required=""> 
                    </div>
                    <div class="form-group   col-lg-4">
                      <label>Sender Name</label>
                      <input type="text" name="sender_name" class="form-control" placeholder="Enter Sender Name"  maxlength="6" value="{{ @$smsApi->sender_id }}" required=""> 
                    </div>  
                    <div class="form-group col-lg-12">
                      <label>URL</label>
                      <textarea  name="url" class="form-control" placeholder="Enter URL" maxlength="250" required="">{{ @$smsApi->url }}</textarea> 
                    </div>
                    <div class="col-lg-12">
                      <label>Enable Auto Send</label>
                        <input type="checkbox" name="enable_auto_send" value="1" {{ @$smsApi->enableautosend==1?'checked' : '' }}>
                    </div>
                    
                    <div class="row"> 
                      <div class="col-lg-12 text-center" style="padding-top: 10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success">
                      </div> 
                    </div> 
              </form> 
         
        </div>
      </div>
    </div>

     
    <!-- /.content -->

 
