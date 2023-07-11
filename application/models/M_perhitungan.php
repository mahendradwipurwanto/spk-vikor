<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perhitungan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getAllProducts($filter = []){

        // $filter['nama'] = [
        //     'EMINA Sun Battle SPF 30 PA+++',
        //     'VOTRE PEAU Facial Sun Shield SPF 50',
        //     'SKIN AQUA UV Mild Milk',
        //     'SKIN AQUA UV Moisture Milk',
        //     'SKIN AQUA UV Whitening Milk'
        // ];

        $this->db->select('sunscreen.*, jenis_kulit.jenisKulit, asal_brand.asalBrand')
        ->from('sunscreen')
        ->join('jenis_kulit', 'sunscreen.idJenisKulit = jenis_kulit.idJenisKulit')
        ->join('asal_brand', 'sunscreen.idAsalBrand = asal_brand.idAsalBrand');
        
        if(isset($filter['nama']) && !empty($filter['nama'])){
            $this->db->where_in('sunscreen.namaProduk', $filter['nama']);
        }
        
        if(isset($filter['idJenisKulit']) && !empty($filter['idJenisKulit'])){
            $this->db->where_in('sunscreen.idJenisKulit', [1, $filter['idJenisKulit']]);
        }
        
        if(isset($filter['idAsalBrand']) && !empty($filter['idAsalBrand'])){
            $this->db->where('sunscreen.idAsalBrand', $filter['idAsalBrand']);
        }
        
        if(isset($filter['harga']) && !empty($filter['harga'])){
            $this->db->where('sunscreen.harga', $filter['harga']);
        }
        
        if(isset($filter['spf']) && !empty($filter['spf'])){
            $this->db->where('sunscreen.spf', $filter['spf']);
        }
        
        if(isset($filter['protectionGrade']) && !empty($filter['protectionGrade'])){
            $this->db->where('sunscreen.protectionGrade', $filter['protectionGrade']);
        }

        $query = $this->db->get()->result();

        $arr = [];
        if(!empty($query)){
            foreach($query as $key => $val){
                $arr[$val->idSunscreen]['id'] = $val->idSunscreen;
                $arr[$val->idSunscreen]['name'] = $val->namaProduk;
                $arr[$val->idSunscreen]['Price'] = (float) $val->harga;
                $arr[$val->idSunscreen]['SPF'] = (float) $val->spf;
                $arr[$val->idSunscreen]['Protection Grade'] = cvtPG($val->protectionGrade);
                $arr[$val->idSunscreen]['Rating'] = (float) $val->ratingProduk;
                $arr[$val->idSunscreen]['Berat'] = (float) $val->berat;
                $arr[$val->idSunscreen]['Users Recommend'] = (float) $val->usersRecommend;
                $arr[$val->idSunscreen]['Users Repurchase'] = (float) $val->usersRepurchase;
            }
        }
        // ej($arr);
        return $arr;
    }

    public function getAllBobot($filter = []){

        $this->db->select('*')
        ->from('kriteria_bobot');
        
        if(isset($filter['name']) && !empty($filter['name'])){
            $this->db->where_in('kriteria_bobot.name', $filter['name']);
        }

        $query = $this->db->get()->result();

        $arr = [];
        if(!empty($query)){
            foreach($query as $key => $val){
                $arr[$key]['id'] = $val->id;
                $arr[$key]['name'] = $val->name;
                $arr[$key]['weight'] = (float) $val->weight;
            }
        }
        return $arr;
    }

    public function save_bobot()
    {
        $bobot = $this->getAllBobot();

        if (!empty($bobot)) {
            $this->db->trans_begin();

            foreach ($bobot as $key => $val) {
                $weight = (float) $this->input->post($val['id']);

                if ($weight > 1) {
                    $this->db->trans_rollback();
                    return [
                        'status' => false,
                        'message' => "Bobot {$val['name']} lebih dari 1"
                    ];
                    break;
                }

                $this->db->where('id', (int) $val['id']);
                $this->db->update('kriteria_bobot', ['weight' => $weight]);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                    return [
                        'status' => false,
                        'message' => "Terjadi kesalahan saat mengubah bobot kriteria"
                    ];
            } else {
                $this->db->trans_commit();
                return [
                    'status' => true,
                    'message' => null
                ];
            }
        }

        return [
            'status' => true,
            'message' => null
        ];
    }

    public function savePerhitungan($params = []){

        $this->db->where('user_id', $this->session->userdata('idUser'));
        $this->db->update('perhitungan', ['status' => 0]);

        $data = [
            'user_id' => $this->session->userdata('idUser'),
            'jenis_kulit_id' => $params['idJenisKulit'],
            'asal_brand_id' => $params['idAsalBrand'],
            'harga' => $params['harga'],
            'spf' => $params['spf'],
            'protection' => ($params['protectionGrade']),
            'total_data' => $params['total_data'],
            'status' => 1,
            'created_at' => time(),
        ];

        $this->db->insert('perhitungan', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function getPerhitunganAktif(){
        $this->db->select('perhitungan.*, jenis_kulit.jenisKulit, asal_brand.asalBrand')
        ->from('perhitungan')
        ->join('jenis_kulit', 'perhitungan.jenis_kulit_id = jenis_kulit.idJenisKulit')
        ->join('asal_brand', 'perhitungan.asal_brand_id = asal_brand.idAsalBrand')
        ->where(['user_id' => $this->session->userdata('idUser'), 'status' => 1, 'is_deleted' => 0]);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return [
                'status' => true,
                'params' => $query->row()
            ];
        }else{
            return [
                'status' => false,
                'params' => null
            ];
        }
    }

    function getPerhitungan($id){
        $this->db->select('perhitungan.*, jenis_kulit.jenisKulit, asal_brand.asalBrand')
        ->from('perhitungan')
        ->join('jenis_kulit', 'perhitungan.jenis_kulit_id = jenis_kulit.idJenisKulit')
        ->join('asal_brand', 'perhitungan.asal_brand_id = asal_brand.idAsalBrand')
        ->where(['id' => $id, 'is_deleted' => 0]);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return [
                'status' => true,
                'params' => $query->row()
            ];
        }else{
            return [
                'status' => false,
                'params' => null
            ];
        }
    }

    function getRiwayatPerhitungan(){
        $this->db->select('perhitungan.*, jenis_kulit.jenisKulit, asal_brand.asalBrand')
        ->from('perhitungan')
        ->join('jenis_kulit', 'perhitungan.jenis_kulit_id = jenis_kulit.idJenisKulit')
        ->join('asal_brand', 'perhitungan.asal_brand_id = asal_brand.idAsalBrand')
        ->where(['user_id' => $this->session->userdata('idUser'), 'is_deleted' => 0]);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return [
                'status' => true,
                'data' => $query->result()
            ];
        }else{
            return [
                'status' => false,
                'data' => null
            ];
        }
    }

}
