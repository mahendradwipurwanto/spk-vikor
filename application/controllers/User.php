<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {

        parent::__construct();
        check_not_login();
        check_admin(); //Akses Level Tiap User
        $this->load->model('user_m');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['row'] = $this->user_m->get();
		$this->template->load('template', 'user/user_data', $data);
    } 
     
    public function add()
    {
        $this->form_validation->set_rules('fullname', 'Nama Lengkap','required');
        $this->form_validation->set_rules('username', 'Username','required|min_length[5]|is_unique[user.username]',
            array('min_length' => '%s minimal 5 karakter')
        );
        $this->form_validation->set_rules('password', 'Password','required|min_length[8]',
            array('min_length' => '%s minimal 8 karakter')
        );
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password','required|matches[password]|min_length[8]',
            array('min_length' => '%s minimal 8 karakter')
        );
        $this->form_validation->set_rules('email', 'Email','required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');
        $this->form_validation->set_message('is_unique', '%s ini sudah ada, silahkan anda ganti');
        $this->form_validation->set_message('matches', '%s tidak sesuai dengan password');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->add($post);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                // echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            redirect(site_url('user'));
            // echo "<script>window.location='".site_url('user')."';</script>"; 
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('fullname', 'Nama Lengkap','required');
        $this->form_validation->set_rules('username', 'Username','required|min_length[5]|callback_username_check',
            array('min_length' => '%s minimal 5 karakter')
        );
        if($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Password','min_length[8]',
                array('min_length' => '%s minimal 8 karakter')
            );
        }
        if($this->input->post('password')){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password','matches[password]|min_length[8]',
                array('min_length' => '%s minimal 8 karakter')
            );
        }
        
        $this->form_validation->set_rules('email', 'Email','required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');
        $this->form_validation->set_message('is_unique', '%s ini sudah ada, silahkan anda ganti');
        $this->form_validation->set_message('matches', '%s tidak sesuai dengan password');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $query = $this->user_m->get($id);
            if($query->num_rows() > 0){
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else{
                $this->session->set_flashdata('notif_warning', 'Data tidak ditemukan');
                redirect(site_url('user'));
                // echo "<script>alert('Data tidak ditemukan');"; 
                // echo "window.location='".site_url('user')."';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->edit($post);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('notif_success', 'Data berhasil disimpan');
                // echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            redirect(site_url('user'));
            // echo "<script>window.location='".site_url('user')."';</script>"; 
        }
    }

    function username_check(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND idUser != '$post[idUser]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('username_check', '%s ini sudah digunakan, silahkan diganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete(){
       $id = $this->input->post('idUser');
       $this->user_m->del($id);

       if($this->db->affected_rows() > 0){
        $this->session->set_flashdata('notif_success', 'Data berhasil dihapus');
        // echo "<script>alert('Data berhasil dihapus');</script>"; 
    }
        redirect(site_url('user'));
        // echo "<script>window.location='".site_url('user')."';</script>"; 
    }
    
    
}
