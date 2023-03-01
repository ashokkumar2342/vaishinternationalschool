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
    @include('admin.include.boostrap')
</head> 
<body > 
    @include('schoolDetails.logo_header')
    <div class="row" style="margin-top: 0px">
      <div class="panel panel-default">
        <div class="panel-heading">{{$menu_name!=''?'Sub Menu :: '.$menu_name:''}}</div>
      </div>
          
        @foreach ($roles as $role) 
        @php 
         $admins=Illuminate\Support\Facades\DB::select(DB::raw("call `up_report_role_users` ('$role->id','$user_status')")); 
         $arrayId=1;
         $total_user = count($admins);
         @endphp
          @if( $total_user > 0)
            <div class="row">
              <div class="col-lg-12"> 
                  &nbsp; 
              </div>
              
            </div>

            <table width="618" class="table table-bordered  table-striped">
              <tbody>
                <tr class="primary" style="font-size: 21px">
                  <td width = "100%">
                    <table width="100%">
                      <tr>
                        <td style="width: 100%;" class="text-center">Role :: {{ $role->name }}</td>       
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <table width = "100%">
                      <tr class="success" style="font-size: 18px">
                        <td style="width: 8%;">Sr.No.</td>
                        <td style="width: 23%;">Name</td>
                        <td style="width: 23%;">Mobile</td>
                        <td style="width: 33%;">Email</td>
                        <td style="width: 13%;">Status</td>
                      </tr>    
                      @foreach($admins as $admin)  
                        <tr class="success" style="font-size: 15px">
                          <td>{{ $arrayId++ }}</td>
                          <td>{{ $admin->first_name }}</td>
                          <td>{{ $admin->mobile }}</td>
                          <td>{{ $admin->email }}</td>
                          <td>{{ $admin->userstatus }}</td>
                        </tr>
                      @endforeach    

                    </table>
                  </td>
                </tr>
              </tbody>
            </table>  

            <div class="row">
              <div class="col-lg-12"> 
                  Total Record :<b>{{ $total_user }}</b> 
              </div>
              
            </div>
          @endif

        @endforeach
          
        </div> 
        
        <div class="row">
          <div class="col-lg-4"> 
              &nbsp; 
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