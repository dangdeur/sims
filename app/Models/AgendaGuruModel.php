<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaGuruModel extends Model{
  protected $table = 'agenda_guru';
  protected $primaryKey = 'id_agendaguru';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'kode_agendaguru', 'kode_guru','rombel','mapel','materi','jp1','jp2',
    'S','I','A','TL','BL','D'
    ];
  
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

}
