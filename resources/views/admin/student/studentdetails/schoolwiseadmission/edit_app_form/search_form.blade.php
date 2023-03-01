@extends('admin.layout.base')
@push('links')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('body')
<style> 
</style>
<section class="content-header">
    <h1>Admission Application Edit Form </h1> 
</section>      
<section class="content"> 
    <div class="box"> 
        <div class="box-body">
            <form action="{{ route('admin.student.school.edit.adm.app.search') }}" method="post" class="add_form" no-reset="true" success-content-id="student_app_list">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6">
                    <label>Application No.</label>
                    <span class="fa fa-asterisk"></span>
                    <input type="text" name="application_no" class="form-control" placeholder="Enter Application No." required>  
                </div>
                <div class="col-lg-6"> 
                    <input type="submit" class="form-control btn btn-success" value="Search" style="margin-top:25px"> 
                </div> 
            </div> 
            </form>
            <div class="row" style="margin-top:20px">
                <div class="col-lg-12" id="student_app_list">
                    
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection
