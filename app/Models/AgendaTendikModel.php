<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaTendikModel extends Model{
  protected $table = 'agenda_tendik';
  protected $primaryKey = 'id_agendatendik';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'id_agendatendik','tanggal','kode_agendatendik', 'kode_staf','aktifitas','jabatan'
    ];
    

  
}
