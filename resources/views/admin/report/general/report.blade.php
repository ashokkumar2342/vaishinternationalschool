<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html/jpg/png; charset=utf-8"/>
<head>
   <style> 
      .pagenum:before {
         content: counter(page);
      }
      .page_break{
         page-break-before:always;  
      } 
   </style>
   {{-- @include('admin.include.boostrap') --}}
</head> 
<body > 
   {{-- @include('schoolDetails.logo_header') --}}
   <div class="row" style="margin-top: -30px">
      <div class="panel panel-default">
         <div class="panel-heading text-center">Report</div>
      </div>	
      <table class="table table-striped table-responsive table-condensed table-bordered">
        <thead>
          <tr>  
            @php
              $counter = 0;
              while ($counter < $tcols ){
                @endphp
                <th width = "{{ $qcols[$counter][1] }}%">{{ $qcols[$counter][0] }}</th>
                @php
                $counter = $counter+1;
              }
            @endphp 
          </tr>
        </thead>
        <tbody>
          @foreach ($rs_result as $rs_row)
          <tr>
            @foreach ($rs_row as $value)
              <td>{{ $value }}</td>  
            @endforeach
          </tr> 
          @endforeach     
        </tbody>
      </table> 
  </div> 
    <div class="row">
       <div class="col-lg-4"> 
          Total Record :<b>{{ count($rs_result) }}</b> 
       </div>
       <div class="col-lg-4"> 
          Total Pages :
          <b class="pagenum"></b> 
       </div>
       <div class="col-lg-4"> 
          End of Report 
       </div>
    </div>  
 </body> 
 </html>
</html>