<?php

namespace App\Http\Controllers;
use App\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Snack;

use Validator;
use routes;

use App\Http\Requests\SnackRequest;
use Illuminate\Support\Facades\DB;

class SnackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kegiatan=Kegiatan::whereDate('tglselesai', '>=', Date('Y-m-d'))-> get();
        return view('snack')-> with('kegiatan',$kegiatan);
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
    public function store(SnackRequest $request)
    {
        $user=\Auth::user();

         $data = [
          
             'tanggal'     => date('Y-m-d'),
            'kegiatan_id' => $request['kegiatan_id'],
            'user_id'   => $user->id,
            'ns_siang'    => $request['ns_siang'],
            'tkno_siang'  => $request['tkno_siang'],
            'tamu_siang'  => $request['tamu_siang'], 

            'ss_malam'    => $request['ss_malam'],
            'ns_malam'    => $request['ns_malam'],
            'tkno_malam'  => $request['tkno_malam'],
            'tamu_malam'  => $request['tamu_malam']

          


        ];

    
       
        $kegiatan = Kegiatan::where('id','=',$request['kegiatan_id'])->with('kuota')->first();
        $error=array();
        foreach ($data as $key => $value) {
            if ($key !='tanggal' && $key !='user_id' && $key !='kegiatan_id'){
                if ($value >= $kegiatan->kuotaone->jumlah_kuota){
                    $error[]= array('name'=>$key, 'message' => 'Batas Kuota Maksimal '.$kegiatan->kuotaone->jumlah_kuota);

                                    } 
            }
            # code...
        }
       if (count($error)== 0){
       // print_r($error); die();
             return Snack::create($data);
      
        }
        else
        {
            return ['error'=>1, 'data'=>$error];
        }
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
        $snack = Snack::find($id);
        return $snack;
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
             $snack = Snack::find($id);
            $snack->kegiatan_id =$request['kegiatan_id'];
            $snack->tanggal =date('Y-m-d');
            $snack->ns_siang =$request['ns_siang'];
            $snack->tkno_siang =$request['tkno_siang'];
            $snack->tamu_siang =$request['tamu_siang']; 

            $snack->ss_malam =$request['ss_malam'];
            $snack->ns_malam =$request['ns_malam'];
            $snack->tkno_malam =$request['tkno_malam'];
            $snack->tamu_malam =$request['tamu_malam'];


        $snack->update();
        return $snack;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($snackDel = Snack::destroy($id)){
            return ['success' =>  1];
        }else{
            return ['success' =>  0];
        }
    }
      public function  apiSnack()
    {
        //$snack = Snack::all();
         $snack = Snack::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
         //$meal = Meal::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
        return DataTables::of($snack)
            ->addColumn('action', function($snack) {
                return  
                        '<a onclick="editFormSnack('. $snack->id .')" class=btn btn-primary btn-xs"> <i class="glyphicon glyphicon-edit"> </i> Edit </a>' .
                        '<a href="'.route('pdf.snackday', ['id'=> $snack->id]).'" class=btn btn-primary btn-xs"> <i class="glyphicon glyphicon-edit"> </i> Print struk </a>' .
                        '<a onclick="deleteDataSnack('. $snack->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }
     public function addcheck(){
        $user=\Auth::user()->id;
        $datenow=Date('Y-m-d');
        $snack=Snack::where('user_id','=',$user)->where('tanggal','=',$datenow)->count();
        return ['count'=>$snack];
        

    }
}
