<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
     protected $fillable =['kegiatan', 'tglmulai', 'tglselesai', 'note'];

     public function kuota(){
     	return $this -> hasMany(Karyawan::class, 'kegiatan_id', 'id' );

     	    }
     public function kuotaone(){
          return $this -> hasOne(Karyawan::class, 'kegiatan_id', 'id' );

     }
     public static function getalluser(){
     	$user = User::all();
     	$return=array();
     	foreach ($user as $key => $value) {
     		$return [$value->id]= array('name'=>ucfirst($value->name));

     	}
     	return $return;
     }

}
