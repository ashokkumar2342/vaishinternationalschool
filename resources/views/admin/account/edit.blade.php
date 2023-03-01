<div class="modal-content" >
  <div class="modal-header">
    <button type="button" class="close" id="btn_close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"> User Edit ({{ $account->email }}) </h4>
  </div>
  <div class="modal-body">
    <form id="act_add" content-refresh="dataTable" button-click="btn_close" method="post" action="{{ route('admin.account.edit.post',Crypt::encrypt(@$account->id?@$account->id:0)) }}" class="add_form" no-reset="true" button-click="btn-submit">
     {{ csrf_field() }}
      <div class="row" style="padding-bottom: 30px;"> 
        <div class="col-lg-3">
          <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <span class="fa fa-asterisk"></span>
            <input Name="first_name" class="form-control" value="{{ $account->first_name }}"  maxlength="50" placeholder="Enter first name" required="">
          </div>                                
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>

            <input Name="last_name" class="form-control"  value="{{ $account->last_name }}"  maxlength="50" placeholder="Enter last name">
          </div>                                
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Role</label>
            <span class="fa fa-asterisk"></span>
            <select class="form-control" name="role_id">
              @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $account->role_id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>  
              @endforeach 
            </select>
          </div>                               
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="exampleInputEmail1">E-mail ID</label>
            <span class="fa fa-asterisk"></span>
            <input type="text" name="email" class="form-control" value="{{ $account->email }}" id="exampleInputEmail1" maxlength="100" placeholder="Enter email" required="">
          </div>                                
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="exampleInputEmail1">Mobile.No.</label>
            <span class="fa fa-asterisk"></span>
            <input type="text" Name="mobile" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="{{ $account->mobile }}  " required>
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
