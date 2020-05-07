<?php

namespace App\Http\Controllers;
use App\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Snack;
use Excel;
use route;
use App\Http\Requests\SnackRequest;
use Illuminate\Support\Facades\DB;

class SnackjumlahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
        return view('snackjumlah')-> with('kegiatan',$kegiatan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     public function  apisnackJumlah()
    {

//$user=\Auth::user();
          // $allmeal = Meal::find($user->id);
      //$allmeal = Meal::all()->with('kegiatan')->get();
       //$meal= siswa::where('id','=',$id)->first();

      $allsnack = Snack::select('tanggal','kegiatan_id',
      DB::raw("(SUM(ns_siang)) as ns_siang"),
      DB::raw("(SUM(tkno_siang)) as tkno_siang"),
      DB::raw("(SUM(tamu_siang)) as tamu_siang"),
      DB::raw("(SUM(ss_malam)) as ss_malam"),
      DB::raw("(SUM(ns_malam)) as ns_malam"),
      DB::raw("(SUM(tkno_malam)) as tkno_malam"),
      DB::raw("(SUM(tamu_malam)) as tamu_malam")

      )->groupBy('kegiatan_id','tanggal')->with('kegiatan')->get(); //pertanggal,
      
        return DataTables::of($allsnack)
            ->addColumn('action', function($allsnack) {
                return  
                        
                        '<a onclick="deleteData('. $allsnack->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }



    public function snackjumlahExport() {
        $snackjumlah =Snack::select('tanggal','kegiatan_id',
      DB::raw("(SUM(ns_siang)) as ns_siang"),
      DB::raw("(SUM(tkno_siang)) as tkno_siang"),
      DB::raw("(SUM(tamu_siang)) as tamu_siang"),
      DB::raw("(SUM(ss_malam)) as ss_malam"),
      DB::raw("(SUM(ns_malam)) as ns_malam"),
      DB::raw("(SUM(tkno_malam)) as tkno_malam"),
      DB::raw("(SUM(tamu_malam)) as tamu_malam")

      )->groupBy('kegiatan_id','tanggal')->with('kegiatan')->get();
        // )->with('userid')->with('kegiatan')->get();
                   // print_r($mealsemua);die();

               $printjumlah= array();
                foreach ($snackjumlah as $key => $value) {
                                    # code...
                $printjumlah[]= array(
             'tanggal'=> $value->tanggal,
            'ns_siang'=> $value->ns_siang,
            'tkno_siang'=> $value->tkno_siang,
            'tamu_siang'=> $value->tamu_siang,
            'ss_malam'=> $value->ss_malam,
            'ns_malam'=> $value->ns_malam,
            'tkno_malam'=> $value->tkno_malam,
            'tamu_malam'=> $value->tamu_malam,
          
            'kegiatan'=> $value->kegiatan->kegiatan

            

              );
            }
                                

                       // print_r($printsemua);die();

        return Excel::create('laporan_jumlahSnack', function($excel) use($printjumlah){
                $excel->sheet('mysheet', function($sheet) use ($printjumlah) {
                    $sheet->fromArray($printjumlah);


            });
        })->download('xls');
    }
}
