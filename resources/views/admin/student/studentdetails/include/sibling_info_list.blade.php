<button type="button" class="btn btn-info btn-sm btn_add_sibling_info"  onclick="callPopupLarge(this,'{{ route('admin.sibling.add.form',$student_id) }}')" style="margin: 10px">Add Sibling Detail</button>
<table class="table table-striped table-bordered" id="sibling_items">                         
  <thead>
    <tr>

      <th>Sr.No.</th>
      <th>Sibling Registration No.</th>
      <th>Name</th>
      <th>Class</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  @php
  $arrayId=1;
  @endphp
  <tbody> 
    @foreach($rs_siblings as $val_siblings)   

    <tr> 
      <td>{{ $arrayId++ }}</td>
      <td>{{ $val_siblings->registration_no}}</td>
      <td>{{ $val_siblings->student_name}}</td>
      <td>{{ $val_siblings->class_name}}</td>
      <td>{{ $val_siblings->student_status}}</td> 
      <td>
        <button class="btn btn-danger btn-xs" success-popup="true" button-click="sibling_info_tab" onclick="callAjax(this,'{{ route('admin.sibling.delete',Crypt::encrypt($val_siblings->id)) }}')"><i class="fa fa-trash"></i></button>
      </td>


    </tr>
    @endforeach

  </tbody>
</table>

