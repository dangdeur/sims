<?php namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model{
  protected $table = 'pengguna';
  protected $primaryKey = 'id_pengguna';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['nama_pengguna','kode_pengguna', 'password','nama_depan','nama_belakang','nama_lengkap','email','peran', 'updated_at','no_hp','kunci','updated_at','token'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];




  protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }


}
