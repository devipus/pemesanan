<?php namespace App\Http\Requests;
class KegiatanRequest extends Request {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'kegiatan' =>'max:100',
			'tglmulai' =>'required|date_format:d-m-Y',
			'tglselesai' => 'required|date_format:d-m-Y',
			'note' =>'max:500'
		];
		return [


         'id_unitkerja'=>'integer|exists:users,id',
         'kegiatan_id'=>'integer|exists:kegiatans,id',
         'jumlah_kuota'=>'max:100'
         
         
			
		];
	}
}