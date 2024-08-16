<div class="container">
  <?php 
  //$nama_rombel=array();
  for ($a=0;$a<count($rombel);$a++)
  {
    $nama_rombel[$rombel[$a]['rombel']]=$rombel[$a]['rombel'];
  }
  echo form_open("form_terlambat"); 
  echo form_dropdown('tanggal', $nama_rombel,'', $att=['class'=>'form-select','id'=>'tanggal','required'=>'required']); 
  echo form_submit('tampilkan', 'Tampilkan');
  ?>
  <div id="tampil"></div>
</div>