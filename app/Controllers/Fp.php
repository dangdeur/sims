<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UpacaraModel;
use App\Models\HarianModel;


class Fp extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie', 'date'];
    protected $session;

    public function upacara()
    {
        $Connect = fsockopen('192.168.88.55', "80", $errno, $errstr, 1);
	    if($Connect){
		$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">987</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
        $dataproses['hasil']='sukses';
	    }
        else 
        {
            $dataproses['hasil']='Gagal terkoneksi';
        }

	$model = new UpacaraModel();
	 $buffer=$this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	 $buffer=explode("\r\n",$buffer);
     
	 for($a=0;$a<count($buffer);$a++){
        $datasimpan=array();
	 	$data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");
	 	$PIN=$this->Parse_Data($data,"<PIN>","</PIN>");
	 	$DateTime=$this->Parse_Data($data,"<DateTime>","</DateTime>");
	 	$Verified=$this->Parse_Data($data,"<Verified>","</Verified>");
	 	$Status=$this->Parse_Data($data,"<Status>","</Status>");
        $datasimpan=['kode_absen'=>$PIN,'waktu'=>$DateTime,'verifikasi'=>$Verified,'status'=>$Status];
	 
        $model->insert($datasimpan,false);
	
		
     }
        // return view('header')
        //     . view('menu', $dataproses)
        //     . view('fp')
           
        //     . view('footer');
    }

	/*
	* Tarik data harian
	*
	*
	*/
	public function harian()
    {
        $Connect = fsockopen('192.168.88.56', "80", $errno, $errstr, 1);
	    if($Connect){
		$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">987</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
        $dataproses['hasil']='sukses';
	    }
        else 
        {
            $dataproses['hasil']='Gagal terkoneksi';
        }

	$model = new HarianModel();
	 $buffer=$this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	 $buffer=explode("\r\n",$buffer);
     
	 for($a=0;$a<count($buffer);$a++){
        $datasimpan=array();
	 	$data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");
	 	$PIN=$this->Parse_Data($data,"<PIN>","</PIN>");
	 	$DateTime=$this->Parse_Data($data,"<DateTime>","</DateTime>");
	 	$Verified=$this->Parse_Data($data,"<Verified>","</Verified>");
	 	$Status=$this->Parse_Data($data,"<Status>","</Status>");
        $datasimpan=['kode_absen'=>$PIN,'waktu'=>$DateTime,'verifikasi'=>$Verified,'status'=>$Status];
	 
        $model->insert($datasimpan,false);
	
		
     }
        // return view('header')
        //     . view('menu', $dataproses)
        //     . view('fp')
          
        //     . view('footer');
    }

    public function Parse_Data($data,$p1,$p2){
	$data=" ".$data;
	$hasil="";
	$awal=strpos($data,$p1);
	if($awal!=""){
		$akhir=strpos(strstr($data,$p1),$p2);
		if($akhir!=""){
			$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
		}
	}
	return $hasil;	
    }


	public function olah_harian()
	{
		ini_set('memory_limit', '-1');
		$data = session()->get();
		$fp_model = new HarianModel();
		$data ['kehadiran']=  $fp_model->findAll();
		//d($data);
	}

	

}
