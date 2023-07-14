<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['asal_m', 'jenis_m', 'm_perhitungan']);
        $this->load->library('vikor');
        check_not_login();
        // check_user();
        
    }

    public function index(){

        $filter = [];
        $data['perhitungan_aktif']['status'] = false;

        if($this->session->userdata('level') == 2){

            $get_perhitungan_aktif = $this->m_perhitungan->getPerhitunganAktif();

            if($get_perhitungan_aktif['status']){

                $params = $get_perhitungan_aktif['params'];
                $data['perhitungan_aktif'] = $get_perhitungan_aktif;
                $filter = [
                    'idJenisKulit' => $params->jenis_kulit_id,
                    'idAsalBrand' => $params->asal_brand_id,
                    'harga' => $params->harga,
                    'spf' => $params->spf,
                    'protectionGrade' => $params->protection
                ];
            }
        }
        
        $products = $this->m_perhitungan->getAllProducts($filter);
        $bobot = $this->m_perhitungan->getAllBobot();
        
        // Data dummy
        $data['alternatives'] = $products;
        
        // Bobot kriteria
        $data['criteria_weights'] = $bobot;

        $data['veto'] = [
            1 => 0.25,
            2 => 0.5,
            3 => 0.75
        ];

        // Menghitung perhitungan VIKOR
        $result = $this->vikor->calculate_vikor($data['alternatives'], $data['criteria_weights'], $data['veto']);
        
        $data = array_merge($data, $result);
        // ej($data);
        $this->template->load('template', 'perhitungan/rumus', $data);
    }

    public function hitung(){
        
        $filter = [
            'idJenisKulit' => $this->input->post('jenis_kulit'),
            'idAsalBrand' => $this->input->post('asal_brand'),
            'harga' => $this->input->post('harga'),
            'spf' => $this->input->post('spf'),
            'protectionGrade' => ($this->input->post('protectionGrade')),
        ];
        
        $containsZero = in_array(0, array_values($filter));

        if($containsZero){
			$this->session->set_flashdata('notif_warning', 'Harap pilih semua kriteria!');
			redirect($this->agent->referrer());
        }

        $products = $this->m_perhitungan->getAllProducts($filter);

        $save = [
            'total_data' => count($products),
        ];

        $params = array_merge($save, $filter);

        $save = $this->m_perhitungan->savePerhitungan($params);
        if($save){
			$this->session->set_flashdata('notif_success', 'Berhasil membuat perhitungan, anda dapat melihat perhitungan yang aktif di menu perhitungan dan rekomendasi');
			redirect(site_url('perhitungan'));
		}else{
			$this->session->set_flashdata('notif_warning', 'Terjadi kesalahan saat mencoba membuat perhitungan');
			redirect($this->agent->referrer());
		}
    }

    public function hasil(){

        $filter = [];
        $data['perhitungan_aktif']['status'] = false;

        if($this->session->userdata('level') == 2){

            $get_perhitungan_aktif = $this->m_perhitungan->getPerhitunganAktif();

            if($get_perhitungan_aktif['status']){

                $params = $get_perhitungan_aktif['params'];
                $data['perhitungan_aktif'] = $get_perhitungan_aktif;
                $filter = [
                    'idJenisKulit' => $params->jenis_kulit_id,
                    'idAsalBrand' => $params->asal_brand_id,
                    'harga' => $params->harga,
                    'spf' => $params->spf,
                    'protectionGrade' => $params->protection
                ];
            }
        }
        
        
        $products = $this->m_perhitungan->getAllProducts($filter);
        $bobot = $this->m_perhitungan->getAllBobot();
        
        // Data dummy
        $data['alternatives'] = $products['raw'];
        
        // Bobot kriteria
        $data['criteria_weights'] = $bobot;

        $data['veto'] = [
            1 => 0.25,
            2 => 0.5,
            3 => 0.75
        ];
        // Menghitung perhitungan VIKOR
        $result = $this->vikor->calculate_vikor($products['calc'], $data['criteria_weights'], $data['veto']);
        
        $data = array_merge($data, $result);
        // ej($data);
        $this->template->load('template', 'perhitungan/hasil', $data);
    }

    public function riwayat(){
        $data['riwayat'] = $this->m_perhitungan->getRiwayatPerhitungan();
        $filter = [];
        $data['perhitungan_aktif']['status'] = false;
        
        if(!is_null($this->input->post('riwayat_id'))){
            $get_perhitungan_aktif = $this->m_perhitungan->getPerhitungan($this->input->post('riwayat_id'));
            
            if($get_perhitungan_aktif['status']){

                $params = $get_perhitungan_aktif['params'];
                $data['perhitungan_aktif'] = $get_perhitungan_aktif;
                $filter = [
                    'idJenisKulit' => $params->jenis_kulit_id,
                    'idAsalBrand' => $params->asal_brand_id,
                    'harga' => $params->harga,
                    'spf' => $params->spf,
                    'protectionGrade' => $params->protection
                ];
            }
        }
        
        $products = $this->m_perhitungan->getAllProducts($filter);
        $bobot = $this->m_perhitungan->getAllBobot();
        
        // Data dummy
        $data['alternatives'] = $products;
        
        // Bobot kriteria
        $data['criteria_weights'] = $bobot;

        $data['veto'] = [
            1 => 0.25,
            2 => 0.5,
            3 => 0.75
        ];

        // Menghitung perhitungan VIKOR
        $result = $this->vikor->calculate_vikor($data['alternatives'], $data['criteria_weights'], $data['veto']);
        
        $data = array_merge($data, $result);
        // ej($data);
        $this->template->load('template', 'perhitungan/riwayat', $data);
    }
}
