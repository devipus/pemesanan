<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Kegiatan;
use App\Meal;
use Excel;
use App\Http\Requests\MealRequest;
use Illuminate\Support\Facades\DB;

class AllMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
        return view('allmeal')-> with('kegiatan',$kegiatan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealRequest $request)
    {
           $user=\Auth::user();

         $data = [
          
             'tanggal'     => date('Y-m-d'),
            'user_id'   => $user->id,
            'kegiatan_id' => $request['kegiatan_id'],
            'ns_siang'    => $request['ns_siang'],
            'tkno_siang'  => $request['tkno_siang'],
            'tamu_siang'  => $request['tamu_siang'], 

            'ss_malam'    => $request['ss_malam'],
            'ns_malam'    => $request['ns_malam'],
            'tkno_malam'  => $request['tkno_malam'],
            'tamu_malam'  => $request['tamu_malam'],

            'ss_lembur'   => $request['ss_lembur'],
            'ns_lembur'   => $request['ns_lembur'],
            'tkno_lembur' => $request['tkno_lembur'],
            'tamu_lembur' => $request['tamu_lembur']


        ];
        return Meal::create($data);
       
      
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
        $meal = Meal::find($id);
        return $meal;
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

      

        $meal = Meal::find($id);

            $meal->tanggal =date('Y-m-d');
            $meal->kegiatan_id =$request['kegiatan_id'];
            $meal->ns_siang =$request['ns_siang'];
            $meal->tkno_siang =$request['tkno_siang'];
            $meal->tamu_siang =$request['tamu_siang']; 

            $meal->ss_malam =$request['ss_malam'];
            $meal->ns_malam =$request['ns_malam'];
            $meal->tkno_malam =$request['tkno_malam'];
            $meal->tamu_malam =$request['tamu_malam'];

            $meal->ss_lembur =$request['ss_lembur'];
            $meal->ns_lembur =$request['ns_lembur'];
            $meal->tkno_lembur =$request['tkno_lembur'];
            $meal->tamu_lembur =$request['tamu_lembur'];
        $meal->update();
        return $meal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
   {
    if($mealDel = AllMeal::destroy($id)){
            return ['success' =>  1];
        }else{
            return ['success' =>  0];
        }
    }
     public function  apiAllMeal()
    {

//$user=\Auth::user();
          // $allmeal = Meal::find($user->id);
      //$allmeal = Meal::all()->with('kegiatan')->get();
       //$meal= siswa::where('id','=',$id)->first();

      $allmeal = Meal::select('tanggal','kegiatan_id',
      DB::raw("(SUM(ns_siang)) as ns_siang"),
      DB::raw("(SUM(tkno_siang)) as tkno_siang"),
      DB::raw("(SUM(tamu_siang)) as tamu_siang"),
      DB::raw("(SUM(ss_malam)) as ss_malam"),
      DB::raw("(SUM(ns_malam)) as ns_malam"),
      DB::raw("(SUM(tkno_malam)) as tkno_malam"),
      DB::raw("(SUM(tamu_malam)) as tamu_malam"),
      DB::raw("(SUM(ss_lembur)) as ss_lembur"),
      DB::raw("(SUM(ns_lembur)) as ns_lembur"),
      DB::raw("(SUM(tkno_lembur)) as tkno_lembur"),
      DB::raw("(SUM(tamu_lembur)) as tamu_lembur")

      )->groupBy('kegiatan_id','tanggal')->with('kegiatan')->get(); //pertanggal,
      
        return DataTables::of($allmeal)
            ->addColumn('action', function($allmeal) {
                return  
                       ;

            })->make(true);
    }

    public function mealjumlahExport() {
        $mealjumlah =Meal::select('tanggal','kegiatan_id',
      DB::raw("(SUM(ns_siang)) as ns_siang"),
      DB::raw("(SUM(tkno_siang)) as tkno_siang"),
      DB::raw("(SUM(tamu_siang)) as tamu_siang"),
      DB::raw("(SUM(ss_malam)) as ss_malam"),
      DB::raw("(SUM(ns_malam)) as ns_malam"),
      DB::raw("(SUM(tkno_malam)) as tkno_malam"),
      DB::raw("(SUM(tamu_malam)) as tamu_malam"),
      DB::raw("(SUM(ss_lembur)) as ss_lembur"),
      DB::raw("(SUM(ns_lembur)) as ns_lembur"),
      DB::raw("(SUM(tkno_lembur)) as tkno_lembur"),
      DB::raw("(SUM(tamu_lembur)) as tamu_lembur")

      )->groupBy('kegiatan_id','tanggal')->with('kegiatan')->get();
        // )->with('userid')->with('kegiatan')->get();
                   // print_r($mealsemua);die();

               $printjumlah= array();
                foreach ($mealjumlah as $key => $value) {
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
             'ss_lembur'=> $value->ss_lembur,
            'ns_lembur'=> $value->ns_lembur,
            'tkno_lembur'=> $value->tkno_lembur,
            'tamu_lembur'=> $value->tamu_lembur,
          
            'kegiatan'=> $value->kegiatan->kegiatan

            

              );
            }
                                

                       // print_r($printsemua);die();

        return Excel::create('laporan_jumlahmeal', function($excel) use($printjumlah){
                $excel->sheet('mysheet', function($sheet) use ($printjumlah) {
                    $sheet->fromArray($printjumlah);


            });
        })->download('xls');
    }
}
