<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Parent Image</h4> 
        </div>
        <div class="modal-body">              
            <div class="row">
                <div class="col-lg-12">
                    <div id="parent_image"></div>
                    <div class="text-center">
                        <input type="file" name="profile_photo" onchange="imageBind(this)" class="form-control"> 
                    </div> 
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-12 text-center" style="padding-top: 10px"> 
                    <button type="button"   class="btn btn-primary" onclick="imageUpload('{{ route('admin.parents.image.store',$parent_id) }}','parent_info_tab,btn_close')">Save</button>
                </div> 
            </div>  
        </div> 
    </div>
</div>   