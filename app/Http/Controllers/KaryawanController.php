<?php


namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Kegiatan;
use App\User;
use App\Karyawan;
use App\Http\Requests\KaryawanRequest;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
         $user=User::all();
        return view('karyawan')-> with('kegiatan',$kegiatan)-> with('user',$user);
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
    public function store(KaryawanRequest $request)
    {
     

         $data = [
          
             'id_unitkerja' => $request['id_unitkerja'],
            'kegiatan_id' => $request['kegiatan_id'],
            'jumlah_kuota'    => $request['jumlah_kuota']
            


        ];
        return Karyawan::create($data);
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
         $karyawan = Karyawan::find($id);
        return $karyawan;
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

        $karyawan= Karyawan::find($id);

            $karyawan->id_unitkerja =$request['id_unitkerja'];
            $karyawan->kegiatan_id =$request['kegiatan_id'];
            $karyawan->jumlah_kuota =$request['jumlah_kuota'];
            
          
        $karyawan->update();
        return $karyawan;
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if($karyawanDel = Karyawan::destroy($id)){
            return ['success' =>  1];
        }else{
            return ['success' =>  0];
        }
    }


     public function  apiKaryawan()
    {

//$user=\Auth::user();
          // $meal = Meal::find($user->id);

       $karyawan = Karyawan::all();
       //$meal= siswa::where('id','=',$id)->first();
   //$meal = Meal::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
      ///  $meal = Meal::select('tanggal',DB::raw("(SUM(ns_siang)) as ns_siang"),DB::raw("(SUM(tkno_siang)) as tkno_siang"),DB::raw("(SUM(tamu_siang)) as tamu_siang"),DB::raw("(SUM(ss_malam)) as ss_malam"),DB::raw("(SUM(ns_malam)) as ns_malam"))->groupBy('tanggal')->get(); //pertanggal,
        return DataTables::of($karyawan)
            ->addColumn('action', function($karyawan) {
                return  
                        '<a onclick="editForm('. $karyawan->id .')" class=btn btn-primary btn-xs"> <i class="glyphicon glyphicon-edit"> </i> Edit </a>' .
                        '<a onclick="deleteData('. $karyawan->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }
}
