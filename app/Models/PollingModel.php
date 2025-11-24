<?php namespace App\Models;

use CodeIgniter\Model;

class PollingModel extends Model{
  protected $table = 'polling';
  protected $primaryKey = 'id_polling';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_staf','mapel','jumlah','rerata','pemilih','voting'];
 

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
