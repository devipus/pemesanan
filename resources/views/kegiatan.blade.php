

@extends('layouts.layout')

@section('title')
 home
@endsection

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DATA Kegiatan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Kegiatan</h3>

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
                    <h4>Kegiatan list
                        <a onclick="addFormKegiatan()" class="btn btn-primary pull-right" style="margin-top: -8px;">Add Kegiatan</a>
                        <a onclick="eximKuota()" class="btn btn-primary pull-right" style="margin-top: -8px;">exim Kegiatan</a>
                       
                    </h4>
                </div>
                <div class="panel-body">
                   <table id="kegiatan-table" class="display table" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Kegiatan</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl selesai</th>
                            <th>Note</th>
                            <th></th>
                        </tr>
                    </thead>
      
    </table>
                </div>
            </div>
        </div>
      </div>

          @include('form_kegiatan')
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

$('input.datepicker').datepicker({
  autoclose:true,
 format: 'dd-mm-yyyy'

});
  table = $('#kegiatan-table').DataTable({
                   processing: true,
                      serverSide: true,
                      bLengthChange: true,
                      iDisplayLength: 5,
                      responsive: true,
                      style:'',
                      ajax: "{{ route('api.kegiatan') }}",
                      columns: [
                         {
                              "className":      'details-control',
                              "orderable":      false,
                              "data":           null,
                              "defaultContent": '<b>Lihat Kuota</b>'
                          },
                      
                        {data:    'id',      name: 'id'},
                        {data:    'kegiatan',      name: 'kegiatan'},
                        {data:    'tglmulai',      name: 'tglmulai'},
                        {data:    'tglselesai',      name: 'tglselesai'},
                        {data:    'note',      name: 'note'},
                        {data: 'action', name: 'action', searchable: false}
                      ]



                    });


                         $('#kegiatan-table tbody').on('click', 'td.details-control', function () {
                      var tr = $(this).closest('tr');
                      var row = table.row( tr );
               
                      if ( row.child.isShown() ) {
                          // This row is already open - close it
                          row.child.hide();
                          tr.removeClass('shown');
                      }
                      else {
                          // Open this row
                          row.child( format(row.data()) ).show();
                          tr.addClass('shown');
                      }
                  } );



            var formvalidator =  $('#modal-form form').validator({
                custom:{
                  dateRange1: function(el){
                      var date1=new Date($('#tglmulai').val().split('-').reverse().join('-'));
                      var datenow = new Date();
                      if( datenow >= date1){
                        return "Tanggal mulai tidak boleh lebih kecil dari tanggal saat ini";
                      }

                  },
                  dateRange2: function(){
                      var date1=new Date($('#tglmulai').val().split('-').reverse().join('-'));
                      var date2=new Date($('#tglselesai').val().split('-').reverse().join('-'));

                      if(date1 > date2){
                        return "Tanggal Mulai harus lebih kecil dari tanggal selesai";
                      }

                  }
                }


            });



          formvalidator.on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('kegiatan') }}";
                    else url = "{{ url('kegiatan') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                    success : function(data) {
                         if(data.success == 1){
                            $('#modal-form').modal('hide');
                            document.getElementById('form-kegiatan').reset();
                         table.ajax.reload();
                          swal({
                              title: 'Success!',
                              text: '',
                              type: 'success',
                              timer: '1500'
                          });
                        }else{
                           swal({
                              title: 'Oops...',
                              text: data.message,
                              type: 'error',
                              timer: '1500'
                          });
                        }
                    },
                        error : function(data){
                          var error = data.responseJSON.errors;
                          if(error){
                              $.each(error, function(a,b){// EACH =FOR/FUNCTION
                                var parent = $("input[name='"+a+"']").parents('.form-group');
                                parent.addClass('has-error has-danger');
                                var error='<ul class="list-unstyled">';
                                $.each(b,function(c,d){
                                  error+='<li>'+d+'</li>';
                                                     
                                });
                                error+='</ul>';
                                   parent.find('.help-block.with-errors').html(error);
                                          
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
                    });
                    return false;
                }
            });



                $('#modal-kuota form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('karyawan') }}";
                    else url = "{{ url('karyawan') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-kuota form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-kuota').modal('hide');
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


      function format ( d ) {
        var kuota=d.kuota;
    // `d` is the original data object for the row
    var ret='<table class="table" border="0" >';
    $.each(kuota,function(e,f){

      ret+='<tr><td>'+f.name+':</td><td>'+f.kuota+'</td></tr>';

        

    });
               
   ret +=  '</table>'; return ret;
}
 
    
  function editFormKegiatan(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('kegiatan') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Kegiatan');
                     $('#id').val(data.id);
                      $('#kegiatan').val(data.kegiatan);
                      $('#tglmulai').val(data.tglmulai);
                      $('#tglselesai').val(data.tglselesai);
                      $('#note').val(data.note);
            
                     

          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }

  

   function addFormKegiatan() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        var todaydate=new Date();
        todaydate = todaydate.getDate()+'/'+(todaydate.getMonth()+1)+'/'+todaydate.getFullYear();
        $('.modal-title').text('Add Kegiatan ' +todaydate);
      }





            
      //dibuat duA kali

     function addKuota() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-kuota').modal('show');
        $('#modal-kuota form')[0].reset();
        var todaydate=new Date();
        todaydate = todaydate.getDate()+'/'+(todaydate.getMonth()+1)+'/'+todaydate.getFullYear();
        $('.modal-title').text('Add Kuota  ' +todaydate);
      }

      function eximKuota() {
        $('input[name=_method]').val('POST');
        $('#modal-exim').modal('show');
        $('#modal-exim form')[0].reset();
      }



 function deleteDataKegiatan(id){
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
                  url : "{{ url('kegiatan') }}" + '/' + id,
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
