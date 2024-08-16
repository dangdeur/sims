<?php namespace App\Models;

use CodeIgniter\Model;

class PiketModel extends Model{
  protected $table = 'piket';
  protected $primaryKey = 'id_piket';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['hari','jadwal','petugas_piket','kode_petugas','catatan'];



}
