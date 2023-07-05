<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_user();
        
    }

    public function index(){
        $this->template->load('template', 'kriteria');
    }

}