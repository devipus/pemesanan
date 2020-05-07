
<div class="modal" id="modal-exim" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form  method="post"  action=""
            class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Export  Semua Data Usulan Kebutuhan MEAL</h3>
                </div>

                <div class="modal-body">

                  <div class="form-group">
                        <label for="file" class="col-md-4 control-label">Export</label>
                        <div class="col-md-8">
                            <a href="{{ route('mealsemua.export')}}" class="btn btn-primary">Export</a>
                         
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
             
                    
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>