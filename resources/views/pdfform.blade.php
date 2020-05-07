<style>
li{
 list-style:none;
 line-height: 35px;
height:35px;
margin-bottom: -1px;
padding-left: 5px;
 border:1px solid;

}
li span{
  padding-right: 20px;
  display: block;
  float:left;
  width:200px;
  border-right: 1px solid;
  line-height: 35px;
  margin-right: 5px;
}
ul{

}
</style>


<h1 style="text-align:center;  border-bottom:2px solid; font-family: Arial"> Daftar Usulan Kebutuhan Meal</h1>
<h4 style="text-align:right; "> Tanggal <?php  echo date('d-m-Y', strtotime($datas->tanggal)) ;?></h4>
<h3> Unit Kerja : <?php echo ucfirst( $datas->userid->name);?></h3>
<h3> Kegiatan : <?php echo  ucfirst( $datas->kegiatan->kegiatan);?></h3>



      
           <ul>
            <li> <span> Non staf Siang:  </span><?= $datas->ns_siang; ?> </li>
             <li> <span> Tkno Siang:  </span><?= $datas->tkno_siang; ?> </li>
              <li> <span> Tamu Siang:  </span><?= $datas->tamu_siang; ?> </li>
             <br>
            <li> <span> Staf Malam:  </span><?= $datas->ss_malam; ?> </li>
            <li> <span> Non staf Malam:  </span><?= $datas->ns_malam; ?> </li>
            <li> <span> Tkno Malam:  </span><?= $datas->tkno_malam; ?> </li>
            <li> <span> Tamu Malam:  </span><?= $datas->tamu_malam; ?> </li>
             <br>
            <li> <span> Staf Lembur:  </span><?= $datas->ss_lembur; ?> </li>
            <li> <span> Non staf Lembur:  </span><?= $datas->ns_lembur; ?> </li>
            <li> <span> Tkno Lembur:  </span><?= $datas->tkno_lembur; ?> </li>
            <li> <span> Tamu Lembur:  </span><?= $datas->tamu_lembur; ?> </li>
        
            </ul>
   <br>
<br>
<div>
  <div style="width:180px;float:right">
    <h4>Palembang, <?php  echo date('d-m-Y', strtotime($datas->tanggal)) ;?> </h4>
    <h5></h5>
    <br>
    <br>
    <p style="border-top: 0.3px solid"><br/>NIP. </p>
  </div>
  <div style="clear:both"></div>
</div>


   
   

 

   

 