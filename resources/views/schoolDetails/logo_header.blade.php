@php
  $SchoolDetail = App\Helper\MyFuncs::getReportHeader(); 
@endphp 
<style> 
 span{
 	text-align:middle;display:inline-block;
 	padding-top: 10px;
 }
 
</style>
<table width = "100%">
<tbody width = "100%">
<tr>
<td class="text-nowrap" width = "100%">{!! $SchoolDetail !!}</td>
</tr>
</tbody>
</table>
 