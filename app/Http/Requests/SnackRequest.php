<?php namespace App\Http\Requests;
class SnackRequest extends Request {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [


       
        
         'kegiatan_id'=>'integer|exists:kegiatans,id',
         'ns_siang'=>'max:100',
         'tkno_siang'=>'max:100',
         'tamu_siang'=>'max:100',

         'ss_malam'=>'max:100',
         'ns_malam'=>'max:100',
         'tkno_malam'=>'max:100',
         'tamu_malam'=>'max:100',

			
		];
	}
}
