<?php namespace App\Models;

use CodeIgniter\Model;

class UpacaraModel extends Model{
  protected $table = 'fp_upacara';
  protected $primaryKey = 'id_fp_upacara';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_absen','waktu','verifikasi','status'];
  
  

}
