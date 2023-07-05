<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_m extends CI_Model {

    public function get($id = null){
        $this->db->select('*');
        $this->db->from('jenis_kulit');
        if($id != null){
            $this->db->where('idJenisKulit', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post){
        $params['jenisKulit'] = $post['jenisKulit'];
        $params['keterangan'] = $post['keterangan'];
        $this->db->insert('jenis_kulit', $params );
    }

    public function edit($post){
        $params['jenisKulit'] = $post['jenisKulit'];
        $params['keterangan'] = $post['keterangan'];
        $this->db->where('idJenisKulit', $post['idJenisKulit']);
        $this->db->update('jenis_kulit', $params);
    }

    public function del($id){
        $this->db->where('idJenisKulit', $id);
        $this->db->delete('jenis_kulit');
    }

    public function getJumlahDataJenis() {
        $this->db->from('jenis_kulit');
        return $this->db->count_all_results();
    }

}