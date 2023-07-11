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
            if($filter['harga'] == "400000"){
                $this->db->where('harga >', 400000);
            }else{
                $harga = explode(",", $filter['harga']);
                $this->db->where('harga >=', $harga[0]);
                $this->db->where('harga <=', $harga[1]);
            }
        }
        
        if(isset($filter['spf']) && !empty($filter['spf'])){
            if($filter['harga'] == "400000"){
                $this->db->where('harga >', 400000);
            }else{
                $spf = explode(",", $filter['spf']);
                $this->db->where('sunscreen.spf >=', $spf[0]);
                $this->db->where('sunscreen.spf <=', $spf[1]);
            }
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
        ->from('kriteria_bobot')
        ->where('user_id', $this->session->userdata('idUser'));
        
        if(isset($filter['name']) && !empty($filter['name'])){
            $this->db->where_in('kriteria_bobot.name', $filter['name']);
        }

        $query = $this->db->get()->result();

        $arr = [];
        if(!empty($query)){
            foreach($query as $key => $val){
                $arr[$key]['id'] = $val->id;
                $arr[$key]['user_id'] = $val->user_id;
                $arr[$key]['name'] = $val->name;
                $arr[$key]['weight'] = (float) $val->weight;
            }
        }else{
            $user_id = $this->session->userdata('idUser');
            $data = [
                    [
                        'user_id' => $user_id,
                        'name' => 'Price',
                        'weight' => 0.25,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'SPF',
                        'weight' => 0.1875,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'Protection Grade',
                        'weight' => 0.1875,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'Rating',
                        'weight' => 0.125,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'Berat',
                        'weight' => 0.125,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'Users Recommend',
                        'weight' => 0.0625,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => 'Users Repurchase',
                        'weight' => 0.0625,
                    ]
                ];

            foreach ($data as $key => $val) {
                $arr[$key]['user_id'] = $val['user_id'];
                $arr[$key]['name'] = $val['name'];
                $arr[$key]['weight'] = (float) $val['weight'];

                $this->db->insert('kriteria_bobot', $arr[$key]);
                $arr[$key]['id'] = $this->db->insert_id();
            }
        }
        return $arr;
    }

    public function save_bobot()
    {
        $bobot = $this->getAllBobot();

        if (!empty($bobot)) {
            $total_weight = 0;
            foreach ($bobot as $key => $val) {
                $weight = (float) $this->input->post($val['id']);
                $total_weight = $total_weight + $weight;
            }

            if($total_weight > 1){
                return [
                    'status' => false,
                    'message' => "Total bobot lebih dari 1"
                ];
            }

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
                $this->db->where(['user_id' => $this->session->userdata('idUser'), 'id' => (int) $val['id']]);
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
