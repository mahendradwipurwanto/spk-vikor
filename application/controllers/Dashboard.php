<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model(['sunscreen_m', 'user_m', 'jenis_m', 'asal_m', 'm_perhitungan']);
    }

	public function index()
	{
		check_admin();
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

	public function bobot_kriteria()
	{
		$data['bobot_kriteria'] = $this->m_perhitungan->getAllBobot();
		$this->template->load('template', 'bobot_kriteria', $data);
	}

	public function save_bobot(){
		
		$save = $this->m_perhitungan->save_bobot();

		if($save['status']){
			$this->session->set_flashdata('notif_success', 'Berhasil menyimpan perubahan');
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('notif_warning', $save['message']);
			redirect($this->agent->referrer());
		}
	}
}
