<?php namespace App\Models;

use CodeIgniter\Model;

class RombelModel extends Model{
  protected $table = 'rombel';
  protected $primaryKey = 'id_rombel';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_rombel','nama_rombel','jumlah_siswa'];
 

  // protected function passwordHash(array $data){
  //   if(isset($data['data']['password']))
  //     $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

  //   return $data;
  // }

  // public function data_polling()
  // {
  //   $data = $this->where('aktif',1)->first();
  //   return $data;
  // }

  

}
