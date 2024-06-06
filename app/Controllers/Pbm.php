<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PbmModel;
use CodeIgniter\I18n\Time;

class Pbm extends BaseController
{
  protected $helpers = ['form','text','cookie'];
  protected $pbm=array();

    public function jadwal()
    {
      //$data = $this->session->get();
      $data = session()->get();
      $pbmmodel = new PbmModel();
      $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();
      //               ->first();

      //$data=$data+$jadwal[0];
      $data_jadwal=$this->olah_jadwal($jadwal);
      $data['jadwal']=$this->gabung_jadwal($data_jadwal);
      //dd($data['jadwal']);
      return view('header')
            .view('menu',$data)
            .view('jadwal')
            .view('footer');
     

    }

    public function jadwal_data()
    {
      $pbmmodel = new PbmModel();
      $data = session()->get();
      $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();
      //               ->first();

      //$data=$data+$jadwal[0];
      $data_jadwal=$this->olah_jadwal($jadwal);
      $data['jadwal']=$this->gabung_jadwal($data_jadwal);
      //d($jadwal);
      return $data;
      
    }

    public function olah_jadwal($jadwal)
    {
      $data=[];
      $hari=['senin'=>'1','selasa'=>'2','rabu'=>'3','kamis'=>'4','jumat'=>'5'];
      if (count($jadwal) > 0)
      {
        for ($a=0;$a<count($jadwal);$a++)
        {
          foreach ($hari as $h => $i)
            {
              if ($this->cek($jadwal[$a][$i.'0']))
              {
                $data[$a][$h][$i.'0']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'0']),
                'mapel'=>$jadwal[$a]['mapel_guru']];
              }

              if ($this->cek($jadwal[$a][$i.'1']))
              {
                $data[$a][$h][$i.'1']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'1']),'mapel'=>$jadwal[$a]['mapel_guru']];
              }

              if ($this->cek($jadwal[$a][$i.'2']))
              {
                $data[$a][$h][$i.'2']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'2']),'mapel'=>$jadwal[$a]['mapel_guru']];
                
              }

              if ($this->cek($jadwal[$a][$i.'3']))
              {
                $data[$a][$h][$i.'3']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'3']),'mapel'=>$jadwal[$a]['mapel_guru']];
                //$data[$a][$h][$i.'3']=[];
              }

              if ($this->cek($jadwal[$a][$i.'4']))
              {
                $data[$a][$h][$i.'4']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'4']),'mapel'=>$jadwal[$a]['mapel_guru']];
                //$data[$a][$h][$i.'4']=[];
              }

              if ($this->cek($jadwal[$a][$i.'5']))
              {
                $data[$a][$h][$i.'5']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'5']),'mapel'=>$jadwal[$a]['mapel_guru']];
                // $data[$a][$h][$i.'5']=[];
              }

              if ($this->cek($jadwal[$a][$i.'6']))
              {
                $data[$a][$h][$i.'6']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'6']),'mapel'=>$jadwal[$a]['mapel_guru']];
                //$data[$a][$h][$i.'6']=[];
              }

              if ($this->cek($jadwal[$a][$i.'7']))
              {
                $data[$a][$h][$i.'7']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'7']),'mapel'=>$jadwal[$a]['mapel_guru']];
                //$data[$a][$h][$i.'7']=[];
              }

              if ($i !=5)
              {
                if ($this->cek($jadwal[$a][$i.'8']))
                  {
                    $data[$a][$h][$i.'8']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'8']),'mapel'=>$jadwal[$a]['mapel_guru']];
                    //$data[$a][$h][$i.'8']=[];
                  }
              if ($this->cek($jadwal[$a][$i.'9']))
                  {
                    $data[$a][$h][$i.'9']=['kelas'=>$this->kelas_apa($jadwal[$a][$i.'9']),'mapel'=>$jadwal[$a]['mapel_guru']];
                    // $data[$a][$h][$i.'9']=[];
                  }
                
              }
            }
        }
      }
      //$data=array_filter($data);
      //dd($data);
      return $data;
    }

    public function kelas_apa($kelas)
    {
      if (!empty($kelas))
      {
      $jenjang=['1'=>'X', '2'=>'XI', '3'=>'XII'];
      $jur=[
        '1'=>'ATPH',
        '2'=>'APHP',
        '3'=>'TKR',
        '4'=>'TITL',
        '5'=>'DKV',
        '6'=>'TKJ',
        '7'=>'APL',
        '8'=>'TSM'
      ];
      $arr=str_split($kelas);
      //dd($arr[0]);
      if($arr[0]=='P')
        {
          $rombel="Piket";
        }else {
      $rombel=$jenjang[$arr[0]]." ".$jur[$arr[1]].$arr[2];
        }
      }
      else {
        $rombel='';
      }
      return $rombel;
    }

    public function cek($data)
    {
      if (isset($data) && !empty($data))
      {
        //$kelas=$this->kelas_apa($data);
        return true;
      }
      return false;
    }

    public function gabung_jadwal($data)
    {
      $jadwal=[];
      if (is_array($data))
      {
        foreach ($data as $key => $value) {
          if (isset($value['senin']))
          {
            $jadwal['Senin']=$value['senin'];
          }

          if (isset($value['selasa']))
          {
            $jadwal['Selasa']=$value['selasa'];
          }

          if (isset($value['rabu']))
          {
            $jadwal['Rabu']=$value['rabu'];
          }
          
          if (isset($value['kamis']))
          {
            $jadwal['Kamis']=$value['kamis'];
          }

          if (isset($value['jumat']))
          {
            $jadwal['Jumat']=$value['jumat'];
          }
        }
      }
      //d($jadwal);
      return $jadwal;
    }

    /*
    apakah masih dalam jam guru yg bersangkutan ?

    */
    public function masihkah()
    {
      // $sekarang['hari']=date('N'); //1-senin
      // $sekarang['jam']=date('G'); //0-23
      // $sekarang['menit']=date('i'); //00-59

      //untuk testing
      $sekarang=['hari'=>5,'jam'=>10,'menit'=>10];
    }

    public function del_arr($arr,$del)
    {
      foreach ($del as $a)
      {
        unset($arr[$a]);
      }
      return $arr;
    }
    

}
