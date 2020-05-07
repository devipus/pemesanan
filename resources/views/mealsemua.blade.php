

@extends('layouts.layout')

@section('title')
 home
@endsection

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Semua Usulan kebutuhan Meal
        <small>Silahkan Lihat Data!</small>
      </h1>
      <ol class="breadcrumb">
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Semua Data Usulan kebutuhan Meal</h3>

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
                    <h4>Semua laporan meal
                        <a onclick="eximForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Print Data</a>
                       

                       
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="meal-table" class="table table-striped">
                        <thead>
                            <tr>

                      
                                <th>Tanggal</th>

                                <th>Unit kerja </th>
                                 <th>Kegiatan</th>
                                <th>Ns siang</th>
                                <th>Tkno siang</th>
                                <th>Tamu siang</th>

                                <th>Ssmalam</th>
                                <th>Ns malam </th>
                                <th>Tkno malam</th>
                                <th>Tamu malam</th>

                                <th>Ss lembur</th>
                                <th>Ns lembur</th>
                                <th>Tkno lembur</th>
                                <th>Tamu lembur</th>
            
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>

        
          @include('print_meal')
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
$(document).ready(function() {



    table = $('#meal-table').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: true,
        iDisplayLength: 5,
        responsive: true,

        ajax: "{{ route('api.mealsemua') }}",
        columns: [

            {
                data: 'tanggal',
                name: 'tanggal'
            },
             {
                data: 'userid.name',
                name: 'user'
            },
        


            {
                data: 'kegiatan.kegiatan',
                name: 'kegiatan_id'
            },
            {
                data: 'ns_siang',
                name: 'ns_siang'
            },
            {
                data: 'tkno_siang',
                name: 'tkno_siang'
            },
            {
                data: 'tamu_siang',
                name: 'tamu_siang'
            },

            {
                data: 'ss_malam',
                name: 'ss_malam'
            },
            {
                data: 'ns_malam',
                name: 'ns_malam'
            },
            {
                data: 'tkno_malam',
                name: 'tkno_malam'
            },
            {
                data: 'tamu_malam',
                name: 'tamu_malam'
            },

            {
                data: 'ss_lembur',
                name: 'ss_lembur'
            },
            {
                data: 'ns_lembur',
                name: 'ns_lembur'
            },
            {
                data: 'tkno_lembur',
                name: 'tkno_lembur'
            },
            {
                data: 'tamu_lembur',
                name: 'tamu_lembur'
            },


            {
                data: 'action',
                name: 'action',
                searchable: false
            }
        ]
    });

    $('#modal-form form').validator().on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
            var id = $('#id').val();
            if (save_method == 'add') url = "{{ url('meal') }}";
            else url = "{{ url('meal') . '/' }}" + id;

            $.ajax({
                url: url,
                type: "POST",
                //                        data : $('#modal-form form').serialize(),
                data: new FormData($("#modal-form form")[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: '',
                        type: 'success',
                        timer: '1500'
                    })
                },
                error: function(data) {
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
 function eximForm() {
 
        $('#modal-exim').modal('show');
        $('#modal-exim form')[0].reset();
     
      }







</script>
@endsection
