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

class SnackSemuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
        return view('snacksemua')-> with('kegiatan',$kegiatan);
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
     public function  apiSnackSemua()
    {

//$user=\Auth::user();
          // $meal = Meal::find($user->id);
        //$meal = Meal::with('userid')->with('kegiatan')->get();
      //  $contact = Meal::all();
$snack = Snack::with('userid')->with('kegiatan')->get();
      //  $contact = Meal::all();
       //$meal= siswa::where('id','=',$id)->first();
  // $meal = Meal::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
      ///  $meal = Meal::select('tanggal',DB::raw("(SUM(ns_siang)) as ns_siang"),DB::raw("(SUM(tkno_siang)) as tkno_siang"),DB::raw("(SUM(tamu_siang)) as tamu_siang"),DB::raw("(SUM(ss_malam)) as ss_malam"),DB::raw("(SUM(ns_malam)) as ns_malam"))->groupBy('tanggal')->get(); //pertanggal,
        return DataTables::of($snack)
            ->addColumn('action', function($snack) {
                return  
                        
                        '<a onclick="deleteData('. $snack->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }

 public function snacksemuaExport() {
        $snacksemua = Snack::select('tanggal','ns_siang','user_id','kegiatan_id',
        'tkno_siang',
        'tamu_siang',
        'ss_malam',
        'ns_malam',
        'tkno_malam',
        'tamu_malam'
        
        


         )->with('userid')->with('kegiatan')->get();
                   // print_r($mealsemua);die();

               $printsemua= array();
                foreach ($snacksemua as $key => $value) {
                                    # code...
                $printsemua[]= array(
            'tanggal'=> $value->tanggal,
            'ns_siang'=> $value->ns_siang,
            'tkno_siang'=> $value->tkno_siang,
            'tamu_siang'=> $value->tamu_siang,
            'ss_malam'=> $value->ss_malam,
            'ns_malam'=> $value->ns_malam,
            'tkno_malam'=> $value->tkno_malam,
            'tamu_malam'=> $value->tamu_malam,
            
            'user'=> ucfirst($value->userid->name),
            'kegiatan'=> $value->kegiatan->kegiatan


            

              );
            }
                                

                       // print_r($printsemua);die();

        return Excel::create('Laporan_semuadatasnack', function($excel) use($printsemua){
                $excel->sheet('mysheet', function($sheet) use ($printsemua) {
                    $sheet->fromArray($printsemua);


            });
        })->download('xls');
    }

    
}
