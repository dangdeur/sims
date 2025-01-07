<?php namespace App\Controllers;

class Chat extends BaseController
{
	public function index()
	{
		$data = $this->session->get();
        //$data = [];

		echo view('header', $data)
        . view('menu')
		. view('chat')
		. view('footer');
	}

	//--------------------------------------------------------------------

}