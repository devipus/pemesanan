<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Meal;
use App\Snack;

use PDF;

class pdfController extends Controller
{
    //
    public function mealday()

    {
    	$id= Input::get('id');
    	//return $id; die();
    	if($id){


    	//$datas = Meal::all();
    	//$pdf= PDF::loadview('pdfform',compact('datas'));
    	//return $pdf->download('lampiran.pdf');
    	$datas = Meal::where('id','=',$id)->with('userid')->with('kegiatan')->get();
    		if(count($datas)==1){
    			$datas=$datas[0];

    	$pdf = PDF::setOptions(['defaultFont'=>'Arial'])->loadView('pdfform',compact('datas'));
return $pdf->download('mealday.pdf');}
	}
    }


    public function snackday()

    {
        $id= Input::get('id');
        //return $id; die();
        if($id){


        //$datas = Meal::all();
        //$pdf= PDF::loadview('pdfform',compact('datas'));
        //return $pdf->download('lampiran.pdf');
        $datas = Snack::where('id','=',$id)->with('userid')->with('kegiatan')->get();
            if(count($datas)==1){
                $datas=$datas[0];

        $pdf = PDF::setOptions(['defaultFont'=>'Arial'])->loadView('pdfsnack',compact('datas'));
return $pdf->download('snackday.pdf');}
    }
    }


}
