<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form action="{{route('admin.student.camera.save', $student_id)}}" method="post" class="add_form" button-click="btn_close,student_info_tab">
      <div class="row">
        <div class="col-md-6 form-group">
            <div id="my_camera"></div>
            <br/>
            <input type=button value="Take Snapshot" onclick="take_snapshot()">
            <input type="hidden" name="image" class="image-tag" required>
        </div> 
        <div class="col-md-6" style="margin-top: 30px">
            <div id="results">Your captured image will appear here...</div>
        </div>
        <div class="col-lg-12 form-group text-center" id="btn_save">
              {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        </div>
      </div>
      </form> 
    </div>
  </div>
</div>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script> --}}



<script language="JavaScript">
        Webcam.set({
            width: 250,
            height: 250,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
     
        // Webcam.attach( '#my_camera' );

        // Webcam.snap( function(data_uri) {
        //     document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
        //   } );
      takeSnapShot = function () {
            Webcam.snap(function (data_uri) {
                document.getElementById('snapShot').innerHTML = 
                    '<img src="' + data_uri + '" width="70px" height="50px" />';
            });
        }
         function take_snapshot() { 
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'" width="220px" height="200px" />';
                document.getElementById('btn_save').innerHTML = ' <input type="submit" class="btn btn-success" value="Save">';

            } );
        } 
</script>

