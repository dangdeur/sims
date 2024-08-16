<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaTutaModel extends Model{
  protected $table = 'agenda_tuta';
  protected $primaryKey = 'id_agendatuta';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'id_agendatuta','tanggal','kode_agendatuta', 'kode_staf','aktifitas','jabatan'
    ];
    

  
}
