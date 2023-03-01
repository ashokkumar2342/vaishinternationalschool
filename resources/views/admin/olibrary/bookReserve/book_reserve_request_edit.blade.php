
     <style type="text/css" media="screen">
  .bd{
    border-bottom: #eee solid 1px;;
  }
  
</style>
 
  <div class="modal-dialog" style="width:90%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book Reserve Request Edit</h4>
      </div>
      <div class="modal-body">
       <div class="row"> 
        <div class="col-md-12">
          <form action="{{ route('admin.library.book.reserve.update',$bookReserveRequests->id) }}" method="post" class="add_form" button-click="btn_book_reserve_table_show,btn_close">
                   {{ csrf_field() }}
                   <div class="row">
                    <div class="col-lg-4">
                      <label>Member Ship Type</label>
                      <select name="member_ship_type" class="form-control" >
                        <option disabled selected="">Select Member Ship Type</option> 
                        @foreach ($librarymembertypes as $librarymembertype)
                         <option value="{{ $librarymembertype->id  }}"{{ $bookReserveRequests->member_ship_type_id==$librarymembertype->id? 'selected="selected"' : ''  }}>{{ $librarymembertype->member_ship_type }}</option> 
                         
                        @endforeach 
                      </select>
                    </div>
                    <div class="col-lg-4">
                      <label>Book Name</label>
                     <select name="book_name" class="form-control">
                      <option selected disabled >Select Book Name</option> 
                      @foreach ($booktypes as $booktype) 
                       <option value="{{ $booktype->id }}"{{$bookReserveRequests->book_name_id==$booktype->id? 'selected="selected"' : ''  }}>{{ $booktype->name }}</option>
                      @endforeach 
                     </select> 
                    </div>
                    <div class="col-lg-4">
                      <label>Upto Request Date</label>
                      <input type="date" name="upto_request_date" class="form-control" value="{{ $bookReserveRequests->book_reserve_request }}">  
                    </div>
                    <div class="col-lg-4">
                      <label>Request Valid Upto</label>
                      <input type="date" name="request_valid_upto" class="form-control" value="{{ $bookReserveRequests->due_date }}">  
                    </div>
                     <div class="col-lg-4">
                      <label>Issue Date</label>
                      <input type="date" name="issue_date" class="form-control" value="{{ $bookReserveRequests->issue_date }}">  
                    </div>
                    <div class="col-lg-4">
                       <label>Status</label>
                      <select name="status" class="form-control"> 
                        <option selected disabled>Select Status</option> 
                        @foreach ($bookstatuss as $bookstatus) 
                        <option value="{{ $bookstatus->id }}"{{ $bookReserveRequests->status==$bookstatus->id? 'selected="selected"' : '' }}>{{ $bookstatus->name }}</option>
                        @endforeach 
                      </select> 
                    </div>
                   
                   <div class="row">
                    <div class="col-lg-12 text-center" style="padding-top: 10px">
                      <input type="submit" value="Update" class="btn btn-success">
                    </div>
                     
                   </div>
                 
                
              </form>
            </div>   
              
      <!-- /.row -->
          </div>
          
        </div>
      </div>
   </div>

    <!-- /.content -->

 

