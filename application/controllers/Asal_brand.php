<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asal_brand extends CI_Controller {

    function __construct(){
        parent:: __construct();
        check_not_login();
        check_admin();
        $this->load->model('asal_m');
        $this->load->library('form_validation');

    }

    public function index(){
        $data['row'] = $this->asal_m->get();
        $this->template->load('template', 'asal_brand/asal_data', $data);
    }

    public function add(){
        $this->form_validation->set_rules('asalBrand', 'Asal Brand ','required');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $this->template->load('template', 'asal_brand/asal_form_add');
        }else{
            $post = $this->input->post(null, TRUE);
            $this->asal_m->add($post);
            if($this->db->affected_rows() > 0){
                echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            echo "<script>window.location='".site_url('asal_brand')."';</script>"; 
        }
    }

    public function edit($id){
        $this->form_validation->set_rules('asalBrand', 'Asal Brand','required');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan anda isi');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE){
            $query = $this->asal_m->get($id);
            if($query->num_rows() > 0 ){
                $data['row'] = $query->row();
                $this->template->load('template', 'asal_brand/asal_form_edit', $data);
            }else{
                echo "<script>alert('Data tidak ditemukan');"; 
                echo "window.location='".site_url('asal_brand')."';</script>";
            } 
        }else {
            $post = $this->input->post(null, TRUE);
            $this->asal_m->edit($post);
            if($this->db->affected_rows() > 0){
                echo "<script>alert('Data berhasil disimpan');</script>"; 
            }
            echo "<script>window.location='".site_url('asal_brand')."';</script>"; 
        }
    }

    public function delete(){
        $id = $this->input->post('idAsalBrand');
        $this->asal_m->del($id);
 
        if($this->db->affected_rows() > 0){
         echo "<script>alert('Data berhasil dihapus');</script>"; 
     }
     echo "<script>window.location='".site_url('asal_brand')."';</script>"; 
     }


}