<?php namespace App\Models;

use CodeIgniter\Model;

class WalasModel extends Model{
  protected $table = 'walas';
  protected $primaryKey = 'id_walas';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['rombel','kode_rombel','nama_walas','kode_walas','tapel'];
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
