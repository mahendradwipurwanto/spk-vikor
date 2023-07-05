<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sunscreen_user extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_user();
        $this->load->model('sunscreen_m');
    }

    public function index(){
        $data['row'] = $this->sunscreen_m->get();
        $this->template->load('template', 'sunscreen_user/sunscreen_data', $data);
    }

    // public function detail(){
    //     $this->template->load('template', 'sunscreen_user/sunscreen_detail');
    // }
}