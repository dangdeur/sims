<?php namespace App\Models;

use CodeIgniter\Model;

class TutaModel extends Model{
  protected $table = 'tuta';
  protected $primaryKey = 'id_tuta';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_guru','nama_guru','nip','bidang','jabatan'];
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
