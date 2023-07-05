<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sunscreen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model(['sunscreen_m', 'jenis_m', 'asal_m']);
		// $this->load->model('sunscreen_m');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['row'] = $this->sunscreen_m->get();
		$this->template->load('template', 'sunscreen/sunscreen_data', $data);
	}

	public function add(){
		$sunscreen = new stdClass();	
		$sunscreen->idSunscreen = null;
		$sunscreen->namaProduk = null;
		$sunscreen->harga = null;
		$sunscreen->spf = null;
		$sunscreen->protectionGrade = null;
		$sunscreen->ratingProduk = null;
		$sunscreen->berat= null;
		$sunscreen->usersRecommend = null;
		$sunscreen->usersRepurchase= null;
		$sunscreen->idJenisKulit = null;
		$sunscreen->idAsalBrand = null;
		$sunscreen->namaPerusahaan = null;
		$sunscreen->gambar = null;

		$query_jenis = $this->jenis_m->get();
		$query_asal = $this->asal_m->get();

		$data = array(
			'page' => 'add',
			'row' => $sunscreen,
			'jenis' => $query_jenis,
			'asal' => $query_asal
		);
		$this->template->load('template', 'sunscreen/sunscreen_form_add', $data);
	}

	public function edit($id){
		$query = $this->sunscreen_m->get($id);
		if($query->num_rows() > 0){
			$sunscreen = $query->row();
			$query_jenis = $this->jenis_m->get();
			$query_asal = $this->asal_m->get();

			$data = array(
				'page' => 'edit',
				'row' => $sunscreen,
				'jenis' => $query_jenis,
				'asal' => $query_asal
			);
			$this->template->load('template', 'sunscreen/sunscreen_form_add', $data);
		} else{
			echo "<script>alert('Data tidak ditemukan');"; 
        	echo "window.location='".site_url('sunscreen')."';</script>";
		}
	}

	public function process(){
		$post = $this->input->post(null, TRUE);

		if(isset($_POST['add'])){
			$this->sunscreen_m->add($post);
		} else if(isset($_POST['edit'])){
			$this->sunscreen_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
			echo "<script>alert('Data berhasil disimpan');</script>"; 
		}
			echo "<script>window.location='".site_url('sunscreen')."';</script>"; 
	
	}

	public function delete(){
		$id = $this->input->post('idSunscreen');
       	$this->sunscreen_m->del($id);

       	if($this->db->affected_rows() > 0){
        	echo "<script>alert('Data berhasil dihapus');</script>"; 
    }
        	echo "<script>window.location='".site_url('sunscreen')."';</script>"; 
	}
}
