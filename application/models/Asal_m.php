<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asal_m extends CI_Model {

    public function get($id = null){
        $this->db->select('*');
        $this->db->from('asal_brand');
        if($id != null){
            $this->db->where('idAsalBrand', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        $params['asalBrand'] = $post['asalBrand'];
        $params['keterangan'] = $post['keterangan'];
        $this->db->insert('asal_brand', $params);
    }

    public function edit($post){
        $params['asalBrand'] = $post['asalBrand'];
        $params['keterangan'] = $post['keterangan'];
        $this->db->where('idAsalBrand', $post['idAsalBrand']);
        $this->db->update('asal_brand', $params);
    }

    public function del($id){
        $this->db->where('idAsalBrand', $id);
        $this->db->delete('asal_brand');
    }

    public function getJumlahDataAsal() {
        $this->db->from('asal_brand');
        return $this->db->count_all_results();
    }

}