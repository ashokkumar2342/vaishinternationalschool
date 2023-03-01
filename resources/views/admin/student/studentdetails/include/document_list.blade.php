<button type="button" class="btn btn-info btn-sm" style="margin: 10px" onclick="callPopupLarge(this,'{{ route('admin.student.document.add',$student_id) }}')" >Add Document</button>
<div class="table-responsive">
<table class="table table-striped table-bordered" id="document_items">                         
  <thead>
      <tr>
          <th class="text-nowrap">Sr.No.</th>
          <th class="text-nowrap">Document Type Name</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
    @php
      $arrayId=1;
    @endphp
    @foreach ($documents as $document) 
      <tr>
          <td>{{ $arrayId++}}</td>
          <td>{{ $document->name }}</td>                             
          <td>
            <a href="{{ route('admin.document.download',Crypt::encrypt($document->id)) }}" class="btn btn-xs btn-success" title="" target="blank"><i class="fa fa-download"></i></a>

            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you Sure delete',callAjax(this,'{{ route('admin.document.delete',Crypt::encrypt($document->id)) }}'))" success-popup="true" button-click="documrnt_tab" ><i class="fa fa-trash"></i></a></td>
      </tr>
     @endforeach
  </tbody>
</table>
</div>