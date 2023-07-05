<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprofile_admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        
    }

    public function index(){
        $this->template->load('template', 'user/user_detail');
    }

}