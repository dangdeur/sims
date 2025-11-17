<?php namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model {
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'nama_kegiatan', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'link','status'];

    



}
