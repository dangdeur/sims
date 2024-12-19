<?php namespace App\Models;

use CodeIgniter\Model;

class PklModel extends Model{
  protected $table = 'nilai_pkl';
  protected $primaryKey = 'id_nilai_pkl';
  protected $useAutoIncrement = true;
  protected $allowedFields = [`nis`, `rombel`, `tempat_pkl`, `mulai`, `selesai`, `pembimbing_industri`, `nip_pembimbing_industri`,
                             `pembimbing_sekolah`, `nip_pembimbing_sekolah`, `nilai_tp1`, `nilai_tp2`, `nilai_tp3`, `nilai_tp4`, `nilai_tp5`, 
                             `catatan_pkl`, `sakit`, `ijin`, `alpa`];



}
