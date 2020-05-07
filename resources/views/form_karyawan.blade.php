


<div class="modal" id="modal-kuota" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    


            <div class="row">
                   <div class="row">
                           <div class="col-md-4" style="text-align:center">
                              <div class="form-group">
                      <label for="" class="col-md-4 control-label">Unit Kerja</label>
                      <div class="col-md-8">
                           <select name="kegiatan_id">
                                     <option value="">Pilih Kegiatan</option>
                                    <?php 
                                      foreach ($kegiatan as $key => $value) {
                                        echo '<option value="'.$value->id.'">'.$value->kegiatan.'</option>';
                                      }
                                     ?>
                                      
                                     
                                    </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>
                             
                  </div>
                    </div>
                    <div class="row">
                           <div class="col-md-4" style="text-align:center">
                              <div class="form-group">
                      <label for="" class="col-md-4 control-label">Kegiatan</label>
                      <div class="col-md-8">
                           <select name="id_unitkerja">
                                     <option value="">Unit Kerja</option>
                                    <?php 
                                      foreach ($user as $key => $value) {
                                       echo '<option value="'.$value->id.'">'.$value->name. // name=name yang ingin dipanggil
                                       '</option>';
                                  
                                     }
                                     ?>
                                      
                                     
                                    </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>
                             
                  </div>
                    </div>

                <div class="col-md-4">

                      <div class="form-group">
                      <label for="" class="col-md-4 control-label">Jumlah Kuota</label>
                      <div class="col-md-8">
                          <input type="text" id="jumlah_kuota" name="jumlah_kuota" class="form-control" >
                          <span class="help-block with-errors"></span>
                      </div>
                  

              </div> 

            </div>  

           </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>



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
                    <h3 class="modal-title">Export/Import Contact</h3>
                </div>

                <div class="modal-body">

                  <div class="form-group">
                        <label for="file" class="col-md-4 control-label">Export</label>
                        <div class="col-md-8">
                            <a href="" class="btn btn-primary">Export</a>
                         
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
             
                    <div class="form-group">
                        <label for="file" class="col-md-4 control-label">Import</label>
                        <div class="col-md-8">
                            <input type="file" id="file" name="name" class="form-control" autofocus >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
