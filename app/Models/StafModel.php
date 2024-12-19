<?php namespace App\Models;

use CodeIgniter\Model;

class StafModel extends Model{
  protected $table = 'staf';
  protected $primaryKey = 'id_staf';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'kode_staf', 'nama','nuptk','nip'];
    // protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  // protected function beforeInsert(array $data){
  //   //$data = $this->passwordHash($data);
  //   $data['data']['dibuat'] = date('Y-m-d H:i:s');

  //   return $data;
  // }

  protected function beforeUpdate(array $data){
   // $data = $this->passwordHash($data);
    $data['data']['diupdate'] = date('Y-m-d H:i:s');
    return $data;

  }

 

  
}