<?php namespace App\Http\Requests;
class KaryawanRequest extends Request {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [


         'id_unitkerja'=>'integer|exists:users,id',
         'kegiatan_id'=>'integer|exists:kegiatans,id',
         'jumlah_kuota'=>'max:100'
         
         
			
		];
	}
}
