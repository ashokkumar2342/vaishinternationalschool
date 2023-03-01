<div class="col-lg-12" style="margin-top:10px;">
  Role : <span style="color:#d02ee7 ;margin-bottom: 10px"><b>{{ $role_name }}</b></span>  
  <table class="table table-condensed "id="menu_role_table" style="width: 100%">
    <thead>
      <tr>
        <th>Sub Menu Name</th>
        <th>Main Menu Name</th>
        <th>Status</th>
      </tr>
    </thead>
    @php
      $menu_name = '';
    @endphp
    <tbody>
        @foreach ($rs_result as $menu)
          @if ($menu->menu_name!=$menu_name )
            <tr>
              <td></td>
              <td>{{ $menu->menu_name }}</td>
              <td></td>
            </tr>
            {{$menu_name = $menu->menu_name}}
          @endif
          <tr style="{{ $menu->status?'background-color: #95e49b':'background-color: #ec2020' }}">
            <td>{{ $menu->sub_menu_name }}</td>
            <td></td>
            <td>{{ $menu->status?'Yes':'No' }}</td> 
          </tr>
        @endforeach 
    </tbody>
  </table>
</div>