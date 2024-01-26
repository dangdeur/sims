<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model{
  protected $table = 'agenda';
  protected $primaryKey = 'id_agenda';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_agenda', 'rombel','_1','_2','_3','_4','_5','_6','_7','_8','_9','_10','absensi'];
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
