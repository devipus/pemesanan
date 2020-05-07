<?php


namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Kegiatan;
use App\Meal;
use Excel;
use routes;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\DB;


class MealSemuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
        return view('mealsemua')-> with('kegiatan',$kegiatan);
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
     public function  apiMealSemua()
    {

//$user=\Auth::user();
          // $meal = Meal::find($user->id);
$meal = Meal::with('userid')->with('kegiatan')->get();
      //  $contact = Meal::all();
       //$meal= siswa::where('id','=',$id)->first();
  // $meal = Meal::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
      ///  $meal = Meal::select('tanggal',DB::raw("(SUM(ns_siang)) as ns_siang"),DB::raw("(SUM(tkno_siang)) as tkno_siang"),DB::raw("(SUM(tamu_siang)) as tamu_siang"),DB::raw("(SUM(ss_malam)) as ss_malam"),DB::raw("(SUM(ns_malam)) as ns_malam"))->groupBy('tanggal')->get(); //pertanggal,
        return DataTables::of($meal)
            ->addColumn('action', function($meal) {
                return  
                        
                        '<a onclick="deleteData('. $meal->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }

    public function mealsemuaExport() {
        $mealsemua = Meal::select('tanggal','ns_siang','user_id','kegiatan_id',
        'tkno_siang',
        'tamu_siang',
        'ss_malam',
        'ns_malam',
        'tkno_malam',
        'tamu_malam',
         'ss_lembur',
        'ns_lembur',
        'tkno_lembur',
        'tamu_lembur'
        


         )->with('userid')->with('kegiatan')->get();
                   // print_r($mealsemua);die();

               $printsemua= array();
                foreach ($mealsemua as $key => $value) {
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
             'ss_lembur'=> $value->ss_lembur,
            'ns_lembur'=> $value->ns_lembur,
            'tkno_lembur'=> $value->tkno_lembur,
            'tamu_lembur'=> $value->tamu_lembur,
            'user'=> ucfirst($value->userid->name),
            'kegiatan'=> $value->kegiatan->kegiatan


            

              );
            }
                                

                       // print_r($printsemua);die();

        return Excel::create('Laporan_dataSnack', function($excel) use($printsemua){
                $excel->sheet('mysheet', function($sheet) use ($printsemua) {
                    $sheet->fromArray($printsemua);


            });
        })->download('xls');
    }

    
}
