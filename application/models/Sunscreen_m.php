<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sunscreen_m extends CI_Model {

    public function get($id = null){
        $this->db->select('sunscreen.*, jenis_kulit.jenisKulit, asal_brand.asalBrand');
        $this->db->from('sunscreen');
        $this->db->join('jenis_kulit', 'sunscreen.idJenisKulit = jenis_kulit.idJenisKulit');
        $this->db->join('asal_brand', 'sunscreen.idAsalBrand = asal_brand.idAsalBrand');

        if($id != null){
            $this->db->where('sunscreen.idSunscreen', $id);
        }
        $query= $this->db->get();
        return $query;
    }

    public function add($post){
        $params = [
            'namaProduk' => $post['nameProduct'],
            'harga' => $post['price'],
            'spf' => $post['spf'],
            'protectionGrade' => $post['protectionGrade'],
            'ratingProduk' => $post['rating'],
            'berat' => $post['netto'],
            'usersRecommend' => $post['recommend'],
            'usersRepurchase' => $post['repurchase'],
            'idJenisKulit' => $post['jenis'],
            'idAsalBrand' => $post['asal'],
            'namaPerusahaan' => $post['nameCompany'],
            'gambar' => $post['link']
            
        ];
        $this->db->insert('sunscreen', $params);
    }

    public function edit($post){
        $params = [
            'namaProduk' => $post['nameProduct'],
            'harga' => $post['price'],
            'spf' => $post['spf'],
            'protectionGrade' => $post['protectionGrade'],
            'ratingProduk' => $post['rating'],
            'berat' => $post['netto'],
            'usersRecommend' => $post['recommend'],
            'usersRepurchase' => $post['repurchase'],
            'idJenisKulit' => $post['jenis'],
            'idAsalBrand' => $post['asal'],
            'namaPerusahaan' => $post['nameCompany'],
            'gambar' => $post['link']
        ];
        $this->db->where('idSunscreen', $post['id']);
        $this->db->update('sunscreen', $params);
    }

    public function del($id){
        $this->db->where('idSunscreen', $id);
        $this->db->delete('sunscreen');
    }

    public function getJumlahDataSunscreen() {
        $this->db->from('sunscreen');
        return $this->db->count_all_results();
    }
    

}
