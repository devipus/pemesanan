

@extends('layouts.layout')

@section('title')
 home
@endsection

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <div class="panel-body">
                   
     <div class="">
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Meal list
                       

                       
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="meal-siang-table" class="table table-striped">
                        <thead>
                            <tr>

                      
                                <th>Tanggal</th>
                               
                                <th>Ns siang</th>
                                <th>Tkno siang</th>
                                <th>Tamu siang</th>

                            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>

     
    </div>


                </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- Content Header (Page header) -->
@endsection    

@section('script')
<script type="text/javascript">
 var table
 $(document).ready(function(){



  table = $('#meal-siang-table').DataTable({
                   processing: true,
                      serverSide: true,
                      bLengthChange: true,
                      iDisplayLength: 5,
                      responsive: true,
                      
                      ajax: "{{ route('api.allmeal') }}",
                      columns: [
                      
                        {data:    'tanggal',      name: 'tanggal'},

                        {data:     'ns_siang',  name: 'ns_siang'},
                        {data:     'tkno_siang', name: 'tkno_siang'},
                        {data:    'tamu_siang',  name: 'tamu_siang'},


                        {data: 'action', name: 'action', searchable: false}
                      ]
                    });

            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('allmeal') }}";
                    else url = "{{ url('allmeal') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: '',
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
  });
    
  function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('meal') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Meal');
                      $('#id').val(data.id);
                      $('#kegiatan_id').val(data.kegiatan_id);
                      $('#tanggal').val(data.tanggal);
                      $('#ns_siang').val(data.ns_siang);
                      $('#tkno_siang').val(data.tkno_siang);
                      $('#tamu_siang').val(data.tamu_siang);
            
                    

          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }

  

   function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        var todaydate=new Date();
        todaydate = todaydate.getDate()+'/'+(todaydate.getMonth()+1)+'/'+todaydate.getFullYear();
        $('.modal-title').text('Add Meal  ' +todaydate);
      }


 function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!'
          }).then(function () {
              $.ajax({
                  url : "{{ url('meal') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                     if(data.success == 1){
                     table.ajax.reload();
                      swal({
                          title: 'Success!',
                          text: '',
                          type: 'success',
                          timer: '1500'
                      });
                    }else{
                      var error=data.error;
                      if(error && error.length > 0){
                          $.each(data.errors, function(a,b){
                            $("[name='"+a+"']").parents('.');

                          });
                      }else{
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      });
                    }
                    }
                  },
                  error : function () {
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
          });
        }

            

</script>
@endsection
