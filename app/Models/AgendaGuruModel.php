<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaGuruModel extends Model{
  protected $table = 'agenda_guru';
  protected $primaryKey = 'id_agendaguru';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'kode_agendaguru','tapel','semester', 'tanggal','waktu','lokasi','kode_guru','rombel','mapel','materi','jp0','jp1','absensi',
    'S','I','A','TL','BL','D','status'
    ];
    protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data){
    //$data = $this->passwordHash($data);
    $data['data']['dibuat'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data){
   // $data = $this->passwordHash($data);
    $data['data']['diupdate'] = date('Y-m-d H:i:s');
    return $data;
  }
  
  public function getAgenda()
    {
        $builder = $this->db->table($table);
        return $builder->get();
    }

    // public function getPresensi()
    // {
    //     $builder = $this->db->table($tabel);
    //     $builder->select('*');
    //     $builder->join('category', 'category_id = product_category_id','left');
    //     return $builder->get();
    // }

    public function simpanAgenda($data){
        $query = $this->db->table('agenda_guru')->insert($data);
        return $query;
    }

    public function updateAgenda($data, $id)
    {
        $query = $this->db->table($table)->update($data, array('id_agendaguru' => $id));
        return $query;
    }

    public function hapusAgenda($id)
    {
        $query = $this->db->table($table)->delete(array('id_agendaguru' => $id));
        return $query;
    } 

    public function rekap_absensi()
    {
      $data_db = $this->where('rekap IS NULL',NULL,false)->findAll();
      return ($data_db);
    }

    
}
