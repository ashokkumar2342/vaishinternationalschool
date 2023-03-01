<button type="button" class="add_btn_parets btn btn-info btn-sm" onclick="callPopupLarge(this,'{{ route('admin.parents.add.form',$student_id) }}')" style="margin: 10px">Add Parent Detail</button>
<div class="container-fluid">
    @foreach ($rs_parentInfo as $rs_value) 
      
        <div class="panel panel-default">
            <div class="panel-heading">{{$rs_value->relation}}'s Details</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Name 
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->name}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Mobile No.  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->mobile}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Email  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->email}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                              Date of Birth    
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->dob}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Date of Anniversary  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->doa}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Education.  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->education}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Profession  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->profession}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Annual Income  
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->income}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" style="padding:5px">
                                Alive 
                            </div>
                            <div class="col-lg-8" style="padding:5px">
                                <b>{{$rs_value->islive}}</b>
                            </div>
                        </div>
                    </div>
                    @php
                      $profile = route('admin.parents.image.show',$rs_value->photo);
                    @endphp
                    <div class="col-lg-3 col-md-3 col-xs-3 text-center">
                        <img  src="{{ ($rs_value->photo)? $profile : asset('profile-img/user.png') }}" style="width: 210px; height: 260px;  border: 2px solid #d1f7ec"><br>

                        <button type="button" title="Upload Image" style="margin-top: 5px" class="btn_parents_image btn btn-info btn-xs" crop-image="parent_image" onclick="callPopupLarge(this,'{{ route('admin.parents.image',$rs_value->id) }}')" ><i class="fa fa-image"></i>Image Upload</button>

                        <a class="btn_web btn btn-default btn-xs" style="margin-top: 5px" onclick="callPopupMd(this,'{{ route('admin.student.camera',1) }}')" href="javascript:;"><i class="fa fa-camera"></i></a> 
                    </div>
                </div>
               
                
                <div class="row">
                    <div class="col-lg-3" style="padding:5px">
                        Office Address 
                    </div>
                    <div class="col-lg-9" style="padding:5px">
                        <b>{{$rs_value->office_address}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="padding:5px">
                        Organization Name 
                    </div>
                    <div class="col-lg-9" style="padding:5px">
                        <b>{{$rs_value->organization_address}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="padding:5px">
                        Designation 
                    </div>
                    <div class="col-lg-9" style="padding:5px">
                        <b>{{$rs_value->f_designation}}</b>
                    </div>
                </div>
                <div class="col-lg-10 text-center" style="margin-top: 10px">
                    <button class="btn_medical_view btn btn-warning btn-xs"  onclick="callPopupLarge(this,'{{ route('admin.parents.edit',Crypt::encrypt($rs_value->id)) }}')" data-id=""  ><i class="fa fa-edit"></i></button>

                    <button class="btn btn-danger btn-xs" success-popup="true" button-click="parent_info_tab" title="Delete" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.parents.delete',[Crypt::encrypt($rs_value->id),$student_id]) }}') } else{console_Log('cancel') }"  ><i class="fa fa-trash"></i></button>
               </div> 
            </div>
        </div>
    @endforeach  
</div>