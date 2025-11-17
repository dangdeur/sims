<?php
namespace App\Validation;
use App\Models\SiswaModel;

class SiswaRules
{

  public function validateSiswa(string $str, string $fields, array $data){
    $model = new SiswaModel();
    $user = $model->where('nis', $data['nis'])
                  ->first();

    if(!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }
}
