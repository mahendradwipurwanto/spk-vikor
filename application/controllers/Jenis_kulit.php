<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kulit extends CI_Controller {

    function __construct(){
        parent:: __construct();
        check_not_login();
        check_admin();
        $this->load->model('jenis_m');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['row'] = $this->jenis_m->get();
        $this->template->load('template', 'jenis_kulit/jenis_data', $data);
    }

    public function add(){
        $this->form_validation->set_rules('jenisKulit', 'Jenis Kulit','required');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $this->template->load('template', 'jenis_kulit/jenis_form_add');
        }else{
            $post = $this->input->post(null, TRUE);
            $this->jenis_m->add($post);
            if($this->db->affected_rows() > 0){
                echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            echo "<script>window.location='".site_url('jenis_kulit')."';</script>"; 
        }

    }

    public function edit($id){
        $this->form_validation->set_rules('jenisKulit', 'Jenis Kulit','required');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $query = $this->jenis_m->get($id);
            if($query->num_rows() > 0 ){
                $data['row'] = $query->row();
                $this->template->load('template', 'jenis_kulit/jenis_form_edit', $data);
            }else{
                echo "<script>alert('Data tidak ditemukan');"; 
                echo "window.location='".site_url('jenis_kulit')."';</script>";
            } 
        }else {
            $post = $this->input->post(null, TRUE);
            $this->jenis_m->edit($post);
            if($this->db->affected_rows() > 0){
                echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            echo "<script>window.location='".site_url('jenis_kulit')."';</script>"; 
        }
    }

    public function delete(){
        $id = $this->input->post('idJenisKulit');
        $this->jenis_m->del($id);
 
        if($this->db->affected_rows() > 0){
         echo "<script>alert('Data berhasil dihapus');</script>"; 
     }
     echo "<script>window.location='".site_url('jenis_kulit')."';</script>"; 
     }


}