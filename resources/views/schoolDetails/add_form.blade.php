       
  <!-- Main content -->
   
    <style type="text/css" media="screen">
  .bd{
    border-bottom: #eee solid 1px;;
  }
  
</style>
 
  <div class="modal-dialog" style="width:90%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">School Details</h4>
      </div>
      <div class="modal-body">
       <div class="row"> 
        <div class="col-md-12"> 
             <form action="{{ route('admin.school.details.store') }}" method="post" class="add_form" button-click="btn_event_type_table_show,btn_close">
                   {{ csrf_field() }}
                   <input type="hidden" name="id" value="{{ @$SchoolDetail->id }}">
                   <div class="row">
                    <div class="form-group  col-lg-4">
                      <label>Name</label>
                      <input type="text" name="name" value="{{ @$SchoolDetail->name }}" class="form-control" placeholder="" maxlength="100" required=""> 
                    </div> 
                    <div class="form-group  col-lg-4">
                      <label>Mobile</label>
                      <input type="text" name="mobile" value="{{ @$SchoolDetail->mobile }}" class="form-control" placeholder="" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required=""> 
                    </div> 
                    <div class="form-group  col-lg-4">
                      <label>Contact</label>
                      <input type="text"  value="{{ @$SchoolDetail->contact }}" name="contact" class="form-control" placeholder="" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required=""> 
                    </div> 
                    <div class="form-group  col-lg-2">
                      <label>Logo</label>
                      <input type="file" name="logo"> 
                    </div>
                    <div class="form-group  col-lg-2">
                      <img src="{{ route('admin.school.logo.show',Crypt::encrypt(@$SchoolDetail->logo)) }}" width="80px" height="80px" alt="" title="" /> 
                    </div> 
                    <div class="form-group  col-lg-2">
                      <label>Image</label>
                      <input type="file" name="image"> 
                    </div> 
                    <div class="form-group  col-lg-2">
                      <img src="{{ route('admin.school.logo.show',Crypt::encrypt(@$SchoolDetail->image)) }}" width="80px" height="80px" alt="" title="" /> 
                    </div> 
                    <div class="form-group  col-lg-4">
                      <label>Address</label>
                      <textarea  name="address" class="form-control" required="" maxlength="1000">{{ @$SchoolDetail->address }}</textarea> 
                    </div>  
                   </div>
                   <div class="row">
                     <div class="col-lg-12">
                       <div class="form-group ">
                         <label>Report Header</label>
                         <textarea  name="report_header" class="form-control summernote">{{ @$SchoolDetail->report_header }}</textarea> 
                       </div>
                     </div>
                   </div>
                   <div class="row">
                    <div class="col-lg-12 text-center" style="padding-top: 10px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-success">
                    </div>
                     
                   </div>
                 
                
              </form>
                
            </div>   
               
      <!-- /.row -->
          </div>
         
        </div>
      </div>
     
    <!-- /.content -->

 
