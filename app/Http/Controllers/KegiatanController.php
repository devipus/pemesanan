<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Kegiatan;
use App\Karyawan;
use App\User;
use App\Http\Requests\KegiatanRequest;
use App\Http\Requests\KaryawanRequest;
class KegiatanController extends Controller
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
        return view('kegiatan')-> with('kegiatan',$kegiatan)-> with('user',$user);
     
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
    public function store(KegiatanRequest $request)
    {
        $data = [
        'kegiatan' => $request['kegiatan'],
        'tglmulai' => date('Y-m-d',strtotime($request['tglmulai'])),
        'tglselesai' =>date('Y-m-d',strtotime($request['tglselesai'])),
          'note' => $request['note']
      
   
        ];

       if(Kegiatan::create($data)){
        return ['success'=>1];
       }
       else {
        return ['success'=>0];
       }

       $kuota = [
          
             'id_unitkerja' => $request['id_unitkerja'],
            'kegiatan_id' => $request['kegiatan_id'],
            'jumlah_kuota'    => $request['jumlah_kuota']
            


        ];
         if(Karyawan::create($kuota)){
        return ['success'=>1];
       }
       else {
        return ['success'=>0];
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
          $kegiatan = Kegiatan::find($id);
        return $kegiatan;
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
        

        $kegiatan = Kegiatan::find($id);

           
            $kegiatan->kegiatan =$request['kegiatan'];
        
            $kegiatan->kegiatan=date('Y-m-d',strtotime($request['tglmulai']));
            $kegiatan->kegiatan=date('Y-m-d',strtotime($request['tglselesai']));
            $kegiatan->note =$request['note'];
       if ($kegiatan->update()){
        return ['success'=>1];
       }
       else{
        return ['success'=>0];
       }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       

       if(Kegiatan::destroy($id)){
            return ['success' => 1];
        }
        else
        {
             return ['success' => 0];

        }

    }
     public function  apiKegiatan()
    {
        $kegiatan = Kegiatan::with('kuota')->get();
        //
        
              //return
             

        
        return DataTables::of($kegiatan)
            ->addColumn('kuota', function($kegiatan){
                        if ($kegiatan->kuota){
                            $kuotakegiatan=$kegiatan->kuota;
                            $kuota=array();
                            foreach ($kuotakegiatan as $key => $value) {
                                # code...
                                $kuota[$value->id_unitkerja]= Array(
                                        'id_unitkerja' => $value->id_unitkerja,
                                        'id_kegiatan'=> $value->kegiatan_id,
                                        'kuota'=> $value->jumlah_kuota,
                                    );

                            }
                            
                            $userUnit = Kegiatan::getalluser();
                            $kuotaout= array();
                            //$kuota = array_merge($userUnit,$kuota);
                            foreach ($userUnit as $key => $value) {
                                # code...
                                $kuotaout[]= array(
                                'name' => $value ['name'],
                                'kuota' => (isset($kuota[$key])?$kuota[$key]['kuota']:''),
                                    );




                            }
                            return $kuotaout;
                        }
                        else
                        {
                            return array();
                        }
                    
                        

            })
            ->addColumn('action', function($kegiatan) {
                return 
                        ' <a onclick="addKuota()" class="btn btn-primary pull-right" style="margin-top: -8px;">add kuota</a>'.

                        '<a onclick="editFormKegiatan('. $kegiatan->id .')" class=btn btn-primary btn-xs"> <i class="glyphicon glyphicon-edit"> </i> Edit </a>' .
                        '<a onclick="deleteDataKegiatan('. $kegiatan->id .')" class=btn btn-danger btn-xs"> <i class="glyphicon glyphicon-trash"> </i> Delete </a>' ;

            })->make(true);
    }
}
  // $meal = Meal::where('user_id','=',\Auth::user()->id)->with('kegiatan')->get();
