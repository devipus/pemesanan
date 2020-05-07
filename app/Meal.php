<?php
namespace App;
use  App\Kegiatan;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable =['tanggal', 'user_id', 'kegiatan_id', 'ns_siang', 'tkno_siang', 'tamu_siang', 'ss_malam', 'ns_malam', 'tkno_malam', 'tamu_malam', 'ss_lembur', 'ns_lembur', 'tkno_lembur', 'tamu_lembur'];

    public function kegiatan(){
    		return $this -> hasOne(Kegiatan::class, 'id', 'kegiatan_id');
    }
    public function userid(){
    		return $this -> hasOne(User::class, 'id', 'user_id');
    }
}