<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model(['sunscreen_m', 'user_m', 'jenis_m', 'asal_m']);
    }

	public function index()
	{
		// $data['row'] = $this->sunscreen_m->get();
		$query_sunscreen = $this->sunscreen_m->getJumlahDataSunscreen();
		$query_user = $this->user_m->getJumlahDataUser(); 
		$query_jenis = $this->jenis_m->getJumlahDataJenis();
		$query_asal = $this->asal_m->getJumlahDataAsal();   

		$data = array(
			'row' => $query_sunscreen,
			'user' => $query_user,
			'jenis' => $query_jenis,
			'asal' => $query_asal
		);

		// $data['row'] = $this->sunscreen_m->getJumlahDataSunscreen();
		$this->template->load('template', 'dashboard', $data);
	}
}
