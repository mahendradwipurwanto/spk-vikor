<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model(['asal_m', 'jenis_m']);
        check_not_login();
        check_user();
        
    }

    public function index(){
        $data['asal_brand'] = $this->asal_m->get()->result();
        $data['jenis_kulit'] = $this->jenis_m->get()->result();
        $this->template->load('template', 'kriteria', $data);
    }

}
