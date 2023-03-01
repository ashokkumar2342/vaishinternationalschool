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
<div class="row" style="margin-top: -20px">
<div class="panel panel-warning">
  <div class="panel-heading text-center">Menu Report</div>
  </div>  
 <table class="table table-condensed table-bordered table-striped"id="menu_role_table" style="width: 100%">
    <thead>
    
      <tr>
        <th>Sr.No.</th>
        <th>Menus</th>
        
        
      </tr>
    </thead>
    @php
      $arrayId=1;
      $menu_name = '';
    @endphp
    <tbody>
      @foreach ($rs_result as $menu)
        @if($menu_name != $menu->menu_name)
          @if ($optradio=='menu_wise' && $menu_name != '')
            <tr><td colspan="4"><div class="page_break"></div></td></tr> 
          @endif
          <tr style="background-color: #a24e30">
            <td><h3>{{ $arrayId++ }}</h3></td>
            <td><h3>{{ $menu->menu_name }}</h3></td>
          </tr>
          {{$menu_name = $menu->menu_name}}
        @endif
        <tr style="background-color: #ecd50a">
          <td></td>
          <td>{{ $menu->sub_menu_name }}</td>
        </tr>
      @endforeach 
    </tbody>
  </table>
   </div> 
      <div class="row">
        <div class="col-lg-4"> 
           Total Record :<b>{{ $arrayId ++ -1 }}</b> 
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