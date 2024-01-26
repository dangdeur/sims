<?php namespace App\Models;

use CodeIgniter\Model;

class PbmModel extends Model{
  protected $table = 'jadwal';
  protected $primaryKey = 'id_jadwal';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['nama_guru', 'mapel_guru','jum_x','jum_xi','jum_xii'];
  // protected $beforeInsert = ['beforeInsert'];
  // protected $beforeUpdate = ['beforeUpdate'];

  // protected function beforeInsert(array $data){
  //   $data = $this->passwordHash($data);
  //   $data['data']['updated_at'] = date('Y-m-d H:i:s');
  //
  //   return $data;
  // }
  //
  // protected function beforeUpdate(array $data){
  //   $data = $this->passwordHash($data);
  //   $data['data']['updated_at'] = date('Y-m-d H:i:s');
  //   return $data;
  // }
  //
  // protected function passwordHash(array $data){
  //   if(isset($data['data']['password']))
  //     $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
  //
  //   return $data;
  // }


}
