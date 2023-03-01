@extends('admin.layout.base')
@section('body')
<!-- Main content -->
<section class="content-header text-center"> 
  <h1>Change Password</h1> 
</section>  
<section class="content" style="margin-top:100px">
  <div class="row text-center" style="margin-left:320px" style="margin-top: 600px"> 
    <div class="col-lg-7 text-center"> 
      <div class="login-box-body"> 
          <form name="usser_change_password" id="usser_change_password" toast-msg="true" action="{{ route('vms.change.password.store') }}"   class="add_form" method="post" autocomplete="off" >
              {{ csrf_field()}}
              <div class="form-body overflow-hide">
                  <div class="form-group">
                      <label class="control-label mb-10">Old Password</label>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="icon-lock"></i></div>
                          <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter old password" required="">
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label mb-10" for="exampleInputpwd_01">New Password</label>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="icon-lock"></i></div>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label mb-10" for="exampleInputpwd_01">Confirm password</label>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="icon-lock"></i></div>
                          <input type="password" name="passwordconfirmation" class="form-control" id="passwordconfirmation" placeholder="Enter new password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" oninput="check(this)" required>
                      </div>
                  </div>
              </div>
              <div class="form-actions mt-10">            
                  <button type="submit" class="btn btn-success mr-10 mb-30">Update Password</button>
              </div>              
          </form>
        </div>
      </div> 
    </div>
  </section>
  <!-- /.content -->

  @endsection

