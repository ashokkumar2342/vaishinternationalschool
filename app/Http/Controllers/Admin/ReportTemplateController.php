<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Helper\MyFuncs;


class ReportTemplateController extends Controller
{
    public function index()
    {
        $ReportsTypes = DB::select(DB::raw("select * from `reports_type` order by `name`;"));
        return view('admin.master.reportTemplate.index',compact('ReportsTypes'));
    }

    public function reportTemplateOnChange(Request $request)
    {
        $ReportTemplates = DB::select(DB::raw("select * from `report_templates` where `reports_type_id` = $request->id order by `name`;"));
        return view('admin.master.reportTemplate.table',compact('ReportTemplates'));  
    }

    public function reportTemplateStatus($id,$reports_type_id)
    {

        $id =Crypt::decrypt($id);
        $reports_type_id =Crypt::decrypt($reports_type_id);

        $rs_update = DB::select(DB::raw("call `up_set_default_report_template`($id, $reports_type_id);"));

        $response=['status'=>$rs_update[0]->s_status,'msg'=>$rs_update[0]->result];
        return response()->json($response);
    }

}
