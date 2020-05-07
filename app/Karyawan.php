<?php
namespace App;
use  App\Kegiatan;
use  App\Karyawan;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable =['id_unitkerja', 'kegiatan_id', 'jumlah_kuota'];

    public function kegiatan(){
    		return $this -> hasOne(Kegiatan::class, 'id', 'kegiatan_id');
    }
     public function user(){
    		return $this -> hasOne(User::class, 'id', 'id_unitkerja');  //'id' punya yang diambil -- 'id_unitkerja' yang bawaan karywan
    }
}