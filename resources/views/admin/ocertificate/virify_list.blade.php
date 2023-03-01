<div class="row">
                <div class="col-lg-12"> 
                  <div style="width: 100%; padding-left: -10px; ">
                  <div class="table-responsive">  
                <table id="dataTable" class="table table-striped table-bordered table-responsive">
                  <thead>
                  <tr>               
                    <th>Sr.No</th>
                    <th class="text-nowrap"> Academic Year</th>
                    <th class="text-nowrap">Registration No</th>
                    <th class="text-nowrap">Certificate type</th> 
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Father Name</th> 
                    <th class="text-nowrap">Father Mobile</th> 
                    <th class="text-nowrap">Reason</th> 
                    <th class="text-nowrap">SLC No</th> 
                    <th class="text-nowrap">Udise Code</th> 
                    <th class="text-nowrap">Department School Code</th> 
                    <th class="text-nowrap">File No</th> 
                    <th class="text-nowrap">attachment</th> 
                   {{--  <th>Status</th>  --}}
                   {{--  <th>Remarks</th>  --}}
                    <th class="text-nowrap">Action</th>                  
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($certificates as $certificate)
                  <tr>
                    <td>{{ ++$loop->index }}</td>                  
                    <td>{{ $certificate->academicYear->name or ''}}</td>
                    <td>{{ $certificate->students->registration_no or ''}}</td>
                    @if ($certificate->certificate_type==1)
                         <td>Fee Certificate</td>             
                    @endif 
                     @if ($certificate->certificate_type==2)
                         <td>School Leaving Certificate</td>             
                    @endif  
                     @if ($certificate->certificate_type==3)
                         <td>Character Certificate</td>             
                    @endif
                      @if ($certificate->certificate_type==4)
                         <td>Date of Birth Certificate</td>             
                    @endif         
                    <td>{{ $certificate->students->name or ''}}</td>               
                    <td>
                      @foreach ($students as $student)
                       @if ($student->relation_id==1 or $student->relation_id==null)
                    @if ($student->id==$certificate->student_id)
                    {{ $student->f_name or ''}}               
                    @endif                
                    @endif   
                         
                      @endforeach
                    </td>  
                     <td>
                      @foreach ($students as $student)
                       @if ($student->relation_id==1 or $student->relation_id==null)
                    @if ($student->id==$certificate->student_id)
                    {{ $student->f_mobile or ''}}               
                    @endif                
                    @endif   
                         
                      @endforeach
                    </td>                   
                    <td>{{ $certificate->reason }}</td>
                    <td>{{ $certificate->slc_no }}</td>
                    <td>{{ $certificate->udise_code }}</td>
                    <td>{{ $certificate->department_school_code }}</td>
                    <td>{{ $certificate->file_no }}</td>
                    <td>{{ $certificate->attachment?'Yes':'No'}}</td>
                   {{--  <td> @if ($certificate->status == 1)
                            <button class="btn btn-primary btn-xs">On Active</button> 
                         @elseif($certificate->status == 2)
                           <button class="btn btn-warning btn-xs">Pending</button> 
                         @elseif($certificate->status == 3)
                          <button class="btn btn-success btn-xs">Approval</button>
                         @elseif($certificate->status == 4)
                          <button class="btn btn-danger btn-xs">Cancel</button> 
                         @endif 
                   </td> --}}
                   {{--  <td><button class="btn_add_remarks btn btn-success btn-xs" data-id="{{ $certificate->id }}">Remarks</button></td> --}}

                   
               {{--  @php
                  $signatureStamp=App\Model\SignatureStamp::where('user_id',$admin)->where('certificate_type_id',$certificate->certificate_type)->get();
                @endphp --}}
                {{-- @foreach ($signatureStamp as $signatureStam) 
                   @if ($certificate->certificate_type==$signatureStam->certificate_type_id)  --}}
                    <td class="text-nowrap"> 
                      <button class="btn btn-primary btn-xs" success-popup="true" button-click="btn_certificateIssu_apply_table_show" title="virify" onclick="callAjax(this,'{{ route('admin.student.certificateIssu.edit',$certificate->id) }}')">Virify</button> 
                     <button class="btn btn-danger btn-xs" success-popup="true" button-click="btn_certificateIssu_apply_table_show" title="Reject" onclick="callAjax(this,'{{ route('admin.student.certificateIssu.update',$certificate->id) }}')">Reject</button></td>
                  {{--  @endif
                @endforeach --}}
                     

                   
                  </tr>
                  @endforeach
                  </tbody>
                   
                </table>
              </div></div>
                </div>
              </div>