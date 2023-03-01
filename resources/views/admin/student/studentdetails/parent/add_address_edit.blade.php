<div class="modal-dialog"> 
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Address</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.parents.address.update',Crypt::encrypt($rs_addresses[0]->id)) }}" method="post" class="add_form" button-click="btn_close,address_info">
                {{ csrf_field() }} 
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Category</label> 
                        <span class="fa fa-asterisk"></span>
                        <select name="cotegory_id" class="form-control">
                            <option selected disabled>Select Category </option>
                            @foreach ($cotegorys as $cotegory)
                            <option value="{{ $cotegory->id }}"{{ $cotegory->id==$rs_addresses[0]->category_id?'selected' : '' }}>{{ $cotegory->name }}</option> 
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Religion</label> 
                        <span class="fa fa-asterisk"></span>
                        <select name="religion_id" class="form-control">
                            <option selected disabled>Select Religion</option>
                            @foreach ($religions as $religion)
                            <option value="{{ $religion->id }}"{{ $religion->id==$rs_addresses[0]->religion_id?'selected' : ''  }}>{{ $religion->name }}</option> 
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Nationality</label> <span class="fa fa-asterisk"></span>
                        <select name="nationality" class="form-control">
                            <option selected value="1">Indian</option>
                            <option   value="2">Other Country</option> 
                        </select>
                    </div> 
                    <div class="form-group col-lg-6">
                        <label>State</label> 
                        <span class="fa fa-asterisk"></span>
                        <input type="text" name="state" class="form-control" placeholder="" maxlength="50" value="{{ $rs_addresses[0]->state }}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label>City</label> 
                        <span class="fa fa-asterisk"></span>
                        <input type="text" name="city" class="form-control" placeholder="" maxlength="50" value="{{ $rs_addresses[0]->city }}">
                    </div>
                    <div class="form-group col-lg-8">
                        <label>Permanent  Address</label> 
                        <span class="fa fa-asterisk"></span>
                        <textarea class="form-control" name="p_address" id="p_address" rows="1" maxlength="200"style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >{{ $rs_addresses[0]->p_address }}</textarea>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Pincode</label> 
                        <span class="fa fa-asterisk"></span>
                        <input type="text" name="p_pincode" id="p_pincode" class="form-control" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $rs_addresses[0]->p_pincode }}">
                    </div>
                    <div class="form-group col-lg-12 text-center">
                        <input type="checkbox" id="addressCheck" name="addressCheck" style="margin-top: 30px">
                        <label>Same As</label> 
                    </div>   
                    <div class="form-group col-lg-8">
                        <label>Correspondence Address</label> 
                        <span class="fa fa-asterisk"></span>
                        <textarea class="form-control" name="c_address" rows="1" id="c_address" maxlength="200" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $rs_addresses[0]->c_address }}</textarea>
                    </div> 
                    <div class="form-group col-lg-4">
                        <label>Pincode</label>
                        <input type="number" name="c_pincode" id="c_pincode" class="form-control" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $rs_addresses[0]->c_pincode }}">
                    </div>
                    <div class="form-group col-lg-12 text-center" style="margin-top: 10px">
                        <input type="submit" value="Update" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#addressCheck').click(function(){
        setAddress();
    })
    function setAddress(){
        if ($("#addressCheck").is(":checked")) {
            $('#c_address').val($('#p_address').val());
            $('#c_pincode').val($('#p_pincode').val());
            $('#c_address').attr('readonly', '');
            $('#c_pincode').attr('readonly', '');
        } else {
            $('#c_address').removeAttr('readonly');
            $('#c_pincode').removeAttr('readonly');

        }
    }

    
</script>

